<?php

namespace App\Http\Controllers\Client;

use App\Events\GuestOrderPlaced;
use Illuminate\Support\Facades\Http;
use Log;
use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\ProductVariant;
use App\Models\ProductCapacity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function index()
    {
        $provinces = Http::get('https://vapi.vnappmob.com/api/province/')->json();

        $paymentMethods = PaymentMethod::all();

        if(Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();

            if (!$cart) {
                return redirect()->route('cart.list')->with('error', 'Your shopping cart is empty.');
            }

            $cartItems = CartItem::query()->with(['productVariant','product'])->where('cart_id', $cart->id)->with('product')->get();

            foreach ($cartItems as $item) {

                $productVariant = $item->productVariant;

                $color          = $productVariant->color->name;
                $capacity       = $productVariant->capacity->name;
                $product_name   = $productVariant->product->name;

                if ($productVariant->quantity < $item->quantity) {
                    return redirect()->route('cart.list')->with('error', 'The product "' . $product_name . ' '.$color.' '.$capacity.'"   has insufficient inventory.');
                }

                if ($cartItems->isEmpty()) {
                    return redirect()->route('cart.list')->with('error', 'Your shopping cart is empty.');
                }
            }

            return view('client.checkout', compact('user', 'cartItems', 'paymentMethods', 'provinces'));


        } else {
            $guest_cart = session('cart', []);

            foreach ($guest_cart as $item) {
                $productVariant = ProductVariant::find($item['product_variant_id']);

                if ($productVariant->quantity < $item['quantity']) {
                    return redirect()->route('cart.list')->with('error', 'The product " '.$item['name'].' / '.$item['color'].' / '.$item['capacity'].' " has insufficient inventory.');
                }
            }

            return view('client.guest.checkout', compact('guest_cart', 'paymentMethods','provinces'));
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

    public function processCheckoutForGuests(Request $request) {

        $guest_cart = session('cart', []);

        $request->validate([
            'ship_user_name' => 'required|string|max:255',
            'ship_user_email' => 'required|email|max:255',
            'ship_user_phone' => 'required|string|max:15',
            'ship_user_address' => 'required|string|max:255',
            'payment_method_id' => 'required|integer',
        ]);

        if (empty($guest_cart)) {
            return redirect()->route('cart.list')->with('error', 'Your shopping cart is empty.');
        }

        $paymentMethodId = $request->input('payment_method_id');

        $order = Order::query()->create([
            'user_id' => null,
            'is_guest' => 1,
            'user_name' => $request->ship_user_name,
            'user_email' => $request->ship_user_email,
            'user_address' => $request->ship_user_address,
            'user_phone' => $request->ship_user_phone,

            'ship_user_name' => $request->ship_user_name,
            'ship_user_email' => $request->ship_user_email,
            'ship_user_phone' => $request->ship_user_phone,
            'ship_user_address' => $request->ship_user_address,
            'payment_method_id' => $paymentMethodId,
            'total_price' => $this->calculateTotalGuests($guest_cart),
            'status_order_id' => 1,
            'status_payment_id' => 1,
            'code' => $this->generateOrderCode(),
        ]);


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
                'product_img_thumbnail' => $productVariant->product->img_thumbnail,
                'product_price_regular' => $productVariant->product->price_regular,
                'product_price_sale' => $productVariant->product->price_sale,
                'product_capacity_id' => $productVariant->capacity ? $productVariant->capacity->id : null,
                'product_color_id' => $productVariant->color ? $productVariant->color->id : null,
            ]);
        }


        session(['order_code' => $order->code]);

        if ($paymentMethodId == 2) {

            $this->processVNPAY($order);

        } else {
            GuestOrderPlaced::dispatch($order);

            session()->forget('cart');

            return redirect()->route('guest-checkout.success');
        }
    }


    public function processCheckout(Request $request)
    {
//        dd($request);

        $request->validate([
            'ship_user_name' => 'required|string|max:255',
            'ship_user_email' => 'required|email|max:255',
            'ship_user_phone' => 'required|string|max:15',
            'ship_user_address' => 'required|string|max:255',
        ]);


        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $paymentMethodId = $request->input('payment_method_id');

        // Tạo đơn hàng
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



            'payment_method_id' => $paymentMethodId,
            'total_price' => $this->calculateTotal($cart->id),
            'status_order_id' => 1,
            'status_payment_id' => 1,
            'code' => $this->generateOrderCode(),
        ]);


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
                'product_capacity_id' => $productVariant->capacity ? $productVariant->capacity->id : null, // Kiểm tra capacity
                'product_color_id' => $productVariant->color ? $productVariant->color->id : null, // Kiểm tra color

            ]);
        }

        dd($order);

        if ($paymentMethodId == 2) {
            return $this->processVNPAY($order);
        }

        // Xóa giỏ hàng sau khi thanh toán
        $cart->items()->delete();

        return redirect()->route('checkout.success');
    }

    protected function processVNPAY(Order $order) {

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('checkout.vnpayReturn');
        $vnp_TmnCode = "PMEREN0U";
        $vnp_HashSecret = "0NQH7VYE8X3CW9DI89Q82RVHH5VWONZ0";

        $vnp_TxnRef = $order->code;
        $vnp_OrderInfo = 'Payment for Order #' . $order->id;
        $vnp_OrderType = 'OnlineShopping';
        $vnp_Amount = $order->total_price * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if ($vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function vnpayReturn(Request $request)
    {

        $vnpayData = $request->all();
        $orderId = $vnpayData['vnp_TxnRef'];
        $order = Order::where('code', $orderId)->first();

        if(Auth::check()) {
            if ($vnpayData['vnp_ResponseCode'] == '00') {
                $order->status_payment_id = 2;
                $order->save();

                $cart = Cart::where('user_id', $order->user_id)->first();
                if ($cart) {
                    $cart->items()->delete();
                }

                return redirect()->route('checkout.success');
            } else {
                $order->status_payment_id = 3;
                $order->save();

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
                $order->status_payment_id = 3;
                $order->save();

                return redirect()->route('guest-checkout.failed')->with('error', 'Thanh toán không thành công, vui lòng thử lại.');
            }
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
        if(Auth::check()) {
            $order = Order::where('user_id', Auth::id())
                ->with(['orderItems.product', 'paymentMethod'])
                ->latest()
                ->first();

            if (!$order) {
                return redirect()->route('checkout')->with('error', 'Không tìm thấy đơn hàng.');
            }

            return view('client.success', compact('order'));
        }  else {


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
}



