<?php

namespace App\Http\Controllers\Client;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

    use VnPayTrait;
    public function index()
    {
        $provinces = Http::get('https://vapi.vnappmob.com/api/province/')->json();

        $paymentMethods = PaymentMethod::all();

        $voucher = session('voucher') ? Voucher::where('code', session('voucher'))->first() : null;
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

            return view('client.checkout', compact('user', 'cartItems', 'paymentMethods', 'provinces', 'voucher'));


        } else {
            $guest_cart = session('cart', []);

            foreach ($guest_cart as $item) {
                $productVariant = ProductVariant::find($item['product_variant_id']);

                if ($productVariant->quantity < $item['quantity']) {
                    return redirect()->route('cart.list')->with('error', 'The product " '.$item['name'].' / '.$item['color'].' / '.$item['capacity'].' " has insufficient inventory.');
                }
            }

            return view('client.guest.checkout', compact('guest_cart', 'paymentMethods','provinces', 'voucher'));
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

        $province_code = $request->province;
        $province_name = Http::get("https://provinces.open-api.vn/api/p/{$province_code}")->json();

        $district_code = $request->district;
        $district_name = Http::get("https://provinces.open-api.vn/api/d/{$district_code}")->json();

        $ward_code = $request->ward;
        $ward_name = Http::get("https://provinces.open-api.vn/api/w/{$ward_code}")->json();

        $guest_cart = session('cart', []);
        $voucher = session('voucher') ? Voucher::where('code', session('voucher'))->first() : null;
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

            'shipping_province' => $province_name['name'],
            'shipping_district' => $district_name['name'],
            'shipping_ward' => $ward_name['name'],

            'ship_user_name' => $request->ship_user_name,
            'ship_user_email' => $request->ship_user_email,
            'ship_user_phone' => $request->ship_user_phone,
            'ship_user_address' => $request->ship_user_address,
            'payment_method_id' => $paymentMethodId,
            'total_price' => $this->calculateTotalGuests($guest_cart) - ($voucher ? $voucher->discount : 0),
            'status_order_id' => 1,
            'status_payment_id' => 1,
            'code' => $this->generateOrderCode(),
            'voucher_id' => $voucher ? $voucher->id : null,
        ]);

        // $voucher->used_quantity += 1;
        // $voucher->save();
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

        if ($paymentMethodId == 2) {

            $this->processVNPAY($order);

        } else {
            $this->deductStockProduct();
            GuestOrderPlaced::dispatch($order);

            session()->forget('cart');

            return redirect()->route('guest-checkout.success');
        }
    }


    public function processCheckout(Request $request)
    {

        $province_code = $request->province;
        $province_name = Http::get("https://provinces.open-api.vn/api/p/{$province_code}")->json();

        $district_code = $request->district;
        $district_name = Http::get("https://provinces.open-api.vn/api/d/{$district_code}")->json();

        $ward_code = $request->ward;
        $ward_name = Http::get("https://provinces.open-api.vn/api/w/{$ward_code}")->json();


        $request->validate([
            'ship_user_name' => 'required|string|max:255',
            'ship_user_email' => 'required|email|max:255',
            'ship_user_phone' => 'required|string|max:15',
            'ship_user_address' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $paymentMethodId = $request->input('payment_method_id');
        $voucher = session('voucher') ? Voucher::where('code', session('voucher'))->first() : null;

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

            'shipping_province' => $province_name['name'],
            'shipping_district' => $district_name['name'],
            'shipping_ward' => $ward_name['name'],


            'payment_method_id' => $paymentMethodId,
            'total_price' => $this->calculateTotal($cart->id) - ($voucher ? $voucher->discount : 0),
            'status_order_id' => 1,
            'status_payment_id' => 1,
            'code' => $this->generateOrderCode(),
            'voucher_id' => $voucher ? $voucher->id : null,
        ]);

        $this->deductStockProduct();

        // $voucher->used_quantity += 1;
        // $voucher->save();
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

        if ($paymentMethodId == 2) {
            return $this->processVNPAY($order);
        } else {
            $cart->items()->delete();

            GuestOrderPlaced::dispatch($order);

            return redirect()->route('checkout.success');
        }

        Mail::to($user->email)->send(new OrderPlaced($order));

        $cart->items()->delete();

        return redirect()->route('checkout.success');
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
                $this->deductStockProduct();

                $cart = Cart::where('user_id', $order->user_id)->first();
                if ($cart) {
                    $cart->items()->delete();
                }

                return redirect()->route('checkout.success');
            } else {
                $order->status_payment_id = 3;
                $order->save();

                return redirect()->route('checkout.failed')->with('error', 'Payment failed, please try again.');
            }
        } else {

            if ($vnpayData['vnp_ResponseCode'] == '00') {
                $order->status_payment_id = 2;
                $order->save();
                $this->deductStockProduct();

                session()->forget('cart');

                GuestOrderPlaced::dispatch($order);

                return redirect()->route('guest-checkout.success', compact('order'));
            } else {
                $order->status_payment_id = 3;
                $order->save();

                return redirect()->route('guest-checkout.failed')->with('error', 'Payment failed, please try again.');
            }
        }
    }

    // private function deductStockProduct()
    // {
    //     $user = Auth::user();
    //     if ($user) {
    //         $cart = Cart::where('user_id', $user->id)->first();
    //         $cartItems = CartItem::where('cart_id', $cart->id)->get();
    //         foreach ($cartItems as $cartItem) {
    //             $productVariant = ProductVariant::find($cartItem->product_variant_id);
    //             $productVariant->quantity -= $cartItem->quantity;
    //             $productVariant->save();
    //         }
    //     } else {
    //         $guest_cart = session('cart', []);
    //         foreach ($guest_cart as $item) {
    //             $productVariant = ProductVariant::find($item['product_variant_id']);
    //             $productVariant->quantity -= $item['quantity'];
    //             $productVariant->save();
    //         }
    //     }
    // }

    private function deductStockProduct()
    {
        $user = Auth::user();

        if ($user) {
            $cart = Cart::where('user_id', $user->id)->first();
            if ($cart) {
                $cartItems = CartItem::where('cart_id', $cart->id)->get();

                foreach ($cartItems as $cartItem) {
                    $productVariant = ProductVariant::find($cartItem->product_variant_id);
                    
                    if ($productVariant && $productVariant->quantity >= $cartItem->quantity) {
                        $productVariant->quantity -= $cartItem->quantity;
                        $productVariant->save();
                    } else {
                        // throw new \Exception("Product: " . $productVariant->name . " not enough stock.");
                        return back()->withErrors(['quantity' => 'Quantity exceeds inventory.']);
                    }
                }
            } else {
                throw new \Exception("Cart does not exist.");
            }
        } else {
            $guest_cart = session('cart', []);
            foreach ($guest_cart as $item) {
                $productVariant = ProductVariant::find($item['product_variant_id']);
                
                if ($productVariant && $productVariant->quantity >= $item['quantity']) {
                    $productVariant->quantity -= $item['quantity'];
                    $productVariant->save();
                } else {
                    // throw new \Exception("Product: " . $productVariant->name . " not enough stock.");
                    return back()->withErrors(['quantity' => 'Quantity exceeds inventory.']);
                }
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
                return redirect()->route('checkout')->with('error', 'Order not found.');
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
                return redirect()->route('checkout')->with('error', 'Order not found.');
            }

            return view('client.fail', compact('order'));
        } else {

            return view('client.guest.fail');
        }
    }
}



