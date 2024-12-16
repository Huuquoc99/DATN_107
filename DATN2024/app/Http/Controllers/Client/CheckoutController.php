<?php

namespace App\Http\Controllers\Client;

use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Log;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Voucher;
use App\Models\CartItem;
use App\Mail\OrderPlaced;
use App\Models\OrderItem;
use App\Traits\VnPayTrait;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ProductVariant;
use App\Models\ProductCapacity;
use App\Events\GuestOrderPlaced;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UserPoint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

    use VnPayTrait;

    public function index()
    {

        try {
            $response = Http::get('https://vapi.vnappmob.com/api/province/');

            if ($response->successful()) {
                $provinces = $response->json();
            } else {
                abort(403, 'Mạng không ổn định, vui lòng tải lại trang!');
            }
        } catch (\Exception $e) {
            abort(403, 'Có lỗi xay ra, vui lòng tải lại trang!');
        }


        $paymentMethods = PaymentMethod::all();
        $points = Auth::user()->userPoints->points ?? 0;
        $voucher = session('voucher') ? Voucher::where('code', session('voucher'))->first() : null;
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();

            if (!$cart) {
                return redirect()->route('cart.list')->with('error', 'Giỏ hàng của bạn đang trống.');
            }

            $cartItems = CartItem::query()->with(['productVariant', 'product'])->where('cart_id', $cart->id)->with('product')->get();

            foreach ($cartItems as $item) {

                $productVariant = $item->productVariant;

                $color = $productVariant->color->name;
                $capacity = $productVariant->capacity->name;
                $product_name = $productVariant->product->name;

                if ($productVariant->quantity < $item->quantity) {
                    return redirect()->route('cart.list')->with('error', 'Sản phẩm "' . $product_name . ' ' . $color . ' ' . $capacity . '" không đủ hàng tồn kho.');
                }

                if ($cartItems->isEmpty()) {
                    return redirect()->route('cart.list')->with('error', 'Giỏ hàng của bạn đang trống.');
                }
            }
            return view('client.checkout', compact('user', 'cartItems', 'paymentMethods', 'provinces', 'voucher', 'points'));


        } else {
            $guest_cart = session('cart', []);

            foreach ($guest_cart as $item) {
                $productVariant = ProductVariant::find($item['product_variant_id']);

                if ($productVariant->quantity < $item['quantity']) {
                    return redirect()->route('cart.list')->with('error', 'Sản phẩm " ' . $item['name'] . ' / ' . $item['color'] . ' / ' . $item['capacity'] . ' " không đủ hàng tồn kho.');
                }
            }

            return view('client.guest.checkout', compact('guest_cart', 'paymentMethods', 'provinces', 'voucher'));
        }
    }

    public function getDistricts($provinceId)
    {
        $res = Http::get("https://vapi.vnappmob.com/api/province/district/{$provinceId}")->json();

        $districts = $res['results'] ?? [];

        return response()->json($districts);
    }

    public function getWards($districtId)
    {
        $res = Http::get("https://vapi.vnappmob.com/api/province/ward/{$districtId}")->json();

        $districts = $res['results'] ?? [];

        return response()->json($districts);
    }

    public function processCheckoutForGuests(Request $request)
    {
        $request->validate([
            'ship_user_name' => 'required|string|max:255',
            'ship_user_email' => 'required|email|max:255',
            'ship_user_phone' => 'required|string|max:15',
            'ship_user_address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
        ]);


        if (!session('email_verified')) {
            return redirect()->back()->with('error', 'Vui lòng xác thực email trước khi đặt hàng');
        }

        $province_code = $request->province;
        $province_name = Http::get("https://provinces.open-api.vn/api/p/{$province_code}")->json();

        $district_code = $request->district;
        $district_name = Http::get("https://provinces.open-api.vn/api/d/{$district_code}")->json();

        $ward_code = $request->ward;
        $ward_name = Http::get("https://provinces.open-api.vn/api/w/{$ward_code}")->json();

        $guest_cart = session('cart', []);
        $voucher = session('voucher') ? Voucher::where('code', session('voucher'))->first() : null;


        if (empty($guest_cart)) {
            return redirect()->route('cart.list')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $paymentMethodId = $request->input('payment_method_id');

        $total_guest = $this->calculateTotalGuests($guest_cart);


        $total_price = $total_guest - ($voucher ?
                ($voucher->discount_type == 'percent'
                    ? $total_guest * $voucher->discount / 100
                    : ($voucher->discount_type == 'percent_max'
                        ? min($total_guest * $voucher->discount / 100, $voucher->max_discount)
                        : $voucher->discount))
                : 0
            );

        DB::beginTransaction();

        try {
            $this->deductStockProduct();

            $order = Order::query()->create([
                'user_id' => null,
                'is_guest' => 1,
                'user_name' => $request->ship_user_name,
                'user_email' => $request->ship_user_email,
                'user_address' => $request->ship_user_address,
                'user_phone' => $request->ship_user_phone,

                'shipping_province' => $province_name['name'],
                'shipping_district' => $district_name['name'],
                'shipping_ward' => $ward_name['name'],

                'ship_user_name' => $request->ship_user_name,
                'ship_user_email' => $request->ship_user_email,
                'ship_user_phone' => $request->ship_user_phone,
                'ship_user_address' => $request->ship_user_address,
                'payment_method_id' => $paymentMethodId,
                'subtotal' => $request->subtotal,
                'total_price' => $total_price,
                'status_order_id' => 1,
                'status_payment_id' => 1,
                'code' => $this->generateOrderCode(),
                'voucher_id' => $voucher ? $voucher->id : null,
            ]);

            // dd($order);

            if ($voucher) {
                $voucher->used_quantity += 1;
                $voucher->save();
            }

            foreach ($guest_cart as $item) {
                $productVariant = ProductVariant::with(['product', 'capacity', 'color'])->find($item['product_variant_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_variant_id' => $item['product_variant_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'product_name' => $productVariant->product->name,
                    'product_sku' => $productVariant->product->sku,
                    'product_img_thumbnail' => $productVariant->image,
                    'product_price_regular' => $productVariant->price,
                    'product_price_sale' => $productVariant->price,
                    'product_capacity_id' => $productVariant->capacity ? $productVariant->capacity->id : null,
                    'product_color_id' => $productVariant->color ? $productVariant->color->id : null,
                ]);
            }


            session(['order_code' => $order->code]);
            session()->save();
            session()->forget('voucher');

            DB::commit();


            if ($paymentMethodId == 2) {

                $this->processVNPAY($order);

            } else {

                GuestOrderPlaced::dispatch($order);

                session()->forget('cart');
                session(['order_code' => $order->code]);

                return redirect()->route('guest-checkout.success');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: ' . $e->getMessage());
            return redirect()->route('cart.list')->with('error', 'Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại.');
        }
    }

    public function sendVerificationCode(Request $request)
    {

        $email = $request->email;

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        session([
            'email_verification_code' => $verificationCode,
            'email_to_verify' => $email
        ]);

        try {
            Mail::to($email)->send(new EmailVerificationMail($verificationCode));

            return response()->json(['success' => 'Mã xác thực đã được gửi']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi gửi email'], 500);
        }
    }

    public function verifyEmailCode(Request $request)
    {
        $inputCode = $request->verification_code;
        $email = $request->email;

        $sessionCode = session('email_verification_code');
        $sessionEmail = session('email_to_verify');

        if ($inputCode === $sessionCode && $email === $sessionEmail) {
            session()->forget('email_verification_code');
            session()->forget('email_to_verify');

            session(['email_verified' => true]);

            return response()->json(['verified' => true]);
        }

        return response()->json(['verified' => false], 400);
    }

    private function fetchAddressInformation($provinceCode, $districtCode, $wardCode)
    {
        $endpoints = [
            'province' => "https://provinces.open-api.vn/api/p/{$provinceCode}",
            'district' => "https://provinces.open-api.vn/api/d/{$districtCode}",
            'ward' => "https://provinces.open-api.vn/api/w/{$wardCode}"
        ];

        $addressInfo = [];

        foreach ($endpoints as $type => $url) {
            $response = Http::timeout(5)->get($url);

            if ($response->failed()) {
                throw new \Exception("Không thể tải thông tin {$type}");
            }

            $addressInfo[$type] = $response->json('name');
        }

        return $addressInfo;
    }


    public function processCheckout(Request $request)
    {
        try {
            $addressInfo = $this->fetchAddressInformation(
                $request->province,
                $request->district,
                $request->ward
            );
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Không thể xác minh địa chỉ. Vui lòng thử lại.')
                ->withInput();
        }


        $request->validate([
            'ship_user_name' => 'required|string|max:255',
            'ship_user_email' => 'required|email|max:255',
            'ship_user_phone' => 'required|string|max:15',
            'ship_user_address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
        ]);
        DB::beginTransaction();

        try {
            $this->deductStockProduct();

            $user = Auth::user();

            $cart = Cart::where('user_id', $user->id)->first();
            if (!$cart) {
                return redirect()->route('cart.index')->with('error', 'Giỏ hàng không có sản phẩm');
            }

            $paymentMethodId = $request->input('payment_method_id');

            $voucher = session('voucher') ? Voucher::where('code', session('voucher'))->first() : null;

            $subtotal = $this->calculateTotal($cart->id);

            $total_price = $subtotal - ($voucher
                    ? ($voucher->discount_type == 'percent'
                        ? $subtotal * $voucher->discount / 100
                        : ($voucher->discount_type == 'percent_max'
                            ? min($subtotal * $voucher->discount / 100, $voucher->max_discount)
                            : $voucher->discount))
                    : 0);

            $use_points = $request->input('use_points', 0);

            if ($use_points > 0) {

                $userPoints = UserPoint::where('user_id', $user->id)->first();

                if ($userPoints && $userPoints->points >= $use_points) {
                    $total_price -= $use_points;
                    $total_price = max($total_price, 0);
                    $userPoints->points -= $use_points;
                    $userPoints->save();
                } else {
                    return redirect()->route('checkout')->with('error', 'Số điểm không đủ để sử dụng');
                }
            }

            $order = Order::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'user_address' => $user->address,
                'user_phone' => $user->phone,
                'ship_user_name' => $request->ship_user_name,
                'ship_user_email' => $request->ship_user_email,
                'ship_user_phone' => $request->ship_user_phone,
                'ship_user_address' => $request->ship_user_address,
                'shipping_province' => $addressInfo['province'],
                'shipping_district' => $addressInfo['district'],
                'shipping_ward' => $addressInfo['ward'],
                'payment_method_id' => $paymentMethodId,
                'subtotal' => $subtotal,
                'total_price' => $total_price,
                'status_order_id' => 1,
                'status_payment_id' => 1,
                'code' => $this->generateOrderCode(),
                'voucher_id' => $voucher ? $voucher->id : null,
                'use_points' => $use_points,
            ]);


            if ($voucher) {
                $voucher->used_quantity += 1;
                $voucher->save();
            }

            foreach ($cart->items as $item) {
                $productVariant = ProductVariant::with(['product', 'capacity', 'color'])->find($item->product_variant_id);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'product_name' => $item->productVariant->product->name,
                    'product_sku' => $item->productVariant->product->sku,
                    'product_img_thumbnail' => $item->productVariant->product->img_thumbnail,
                    'product_price_regular' => $item->productVariant->product->price_regular,
                    'product_price_sale' => $item->productVariant->product->price_sale,
                    'product_capacity_id' => $productVariant->capacity ? $productVariant->capacity->id : null,
                    'product_color_id' => $productVariant->color ? $productVariant->color->id : null,
                ]);
            }

            session()->forget('voucher');

            DB::commit();

            if ($paymentMethodId == 2) {
                return $this->processVNPAY($order);
            }

            $cart->items()->delete();

            GuestOrderPlaced::dispatch($order);

            return redirect()->route('checkout.success');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout Error: ' . $e->getMessage());
            return redirect()->route('cart.list')->with('error', 'Có lỗi xảy ra trong quá trình đặt hàng. Vui lòng thử lại.');
        }
    }


    public function vnpayReturn(Request $request)
    {
        $vnpayData = $request->all();
        $orderId = $vnpayData['vnp_TxnRef'];
        $order = Order::where('code', $orderId)->first();

        if (Auth::check()) {
            if ($vnpayData['vnp_ResponseCode'] == '00') {
                $order->status_payment_id = 2;
                $order->save();

                GuestOrderPlaced::dispatch($order);

                $cart = Cart::where('user_id', $order->user_id)->first();
                if ($cart) {
                    $cart->items()->delete();
                }

                session()->forget('voucher');

                return redirect()->route('checkout.success');
            } else {

                session()->forget('voucher');

                $order->status_payment_id = 3;
                $order->save();

                \App\Events\OrderPlaced::dispatch($order, 'order_fail_user');
                return redirect()->route('checkout.failed')->with('error', 'Thanh toán không thành công, vui lòng thử lại.');
            }
        } else {

            if ($vnpayData['vnp_ResponseCode'] == '00') {
                $order->status_payment_id = 2;
                $order->save();

                session()->forget('cart');

                GuestOrderPlaced::dispatch($order);

                return redirect()->route('guest-checkout.success', compact('order'));
            } else {

                \App\Events\OrderPlaced::dispatch($order, 'order_fail_guest');
                session()->forget('voucher');
                $order->status_payment_id = 3;
                $order->save();

                return redirect()->route('guest-checkout.failed')->with('error', 'Thanh toán không thành công, vui lòng thử lại.');
            }
        }
    }


    private function deductStockProduct()
    {
        DB::beginTransaction();
        try {
            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->lockForUpdate()->first();
                $cartItems = CartItem::where('cart_id', $cart->id)->get();
            } else {
                $cartItems = collect(session('cart', []));
            }

            foreach ($cartItems as $item) {
                $productVariant = ProductVariant::query()->lockForUpdate()->find(
                    Auth::check() ? $item->product_variant_id : $item['product_variant_id']
                );

                $requestQuantity = Auth::check() ? $item->quantity : $item['quantity'];

                if ($productVariant->quantity < $requestQuantity) {
                    DB::rollBack();
                    throw new \Exception("Sản phẩm {$productVariant->product->name} không đủ hàng");
                }

                $productVariant->quantity -= $requestQuantity;
                $productVariant->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    protected function generateOrderCode()
    {
        return 'ORDER-' . strtoupper(uniqid());
    }

    private function calculateTotal($cartId)
    {
        $cartItems = CartItem::where('cart_id', $cartId)->get();
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }
        return $total;
    }

    private function calculateTotalGuests($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function success()
    {
        if (Auth::check()) {
            $order = Order::where('user_id', Auth::id())
                ->with(['orderItems.product', 'paymentMethod'])
                ->latest()
                ->first();

            if (!$order) {
                return redirect()->route('checkout')->with('error', 'Không tìm thấy đơn hàng.');
            }

            return view('client.success', compact('order'));
        } else {


            return view('client.guest.success');
        }
    }

    public function fail()
    {
        if (Auth::check()) {
            $order = Order::where('user_id', Auth::id())
                ->with(['orderItems.product', 'paymentMethod'])
                ->latest()
                ->first();

            if (!$order) {
                return redirect()->route('checkout')->with('error', 'Không tìm thấy đơn hàng.');
            }

            return view('client.fail', compact('order'));
        } else {

            return view('client.guest.fail');
        }
    }

    public function repaymentForGuest()
    {
        $order_code_session = session('order_code');

        $order = Order::query()->where('code', $order_code_session)->first();

        if (
            ($order->status_payment_id == 1 || $order->status_payment_id == 3)
            && $order->status_order_id == 1
            && $order->payment_method_id == 2
        ) {
            $this->processVNPAY($order);
        } else {
            return redirect()->back()->with('error', 'Không thể thanh toán đơn hàng.');
        }
    }

}



