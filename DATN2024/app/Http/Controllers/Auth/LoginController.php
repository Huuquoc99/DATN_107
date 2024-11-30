<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin(){
        return view('client.auth.register');
    }

    public function login(Request $request)
    {
    //    dd($request);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:20', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
        ]);


        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $this->mergeSessionCartToDbCart();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    protected function mergeSessionCartToDbCart()
    {
        $sessionCart = session('cart');

        if (Auth::check() && !empty($sessionCart)) {
            $dbCart = Cart::with(['items.productVariant.product'])
                ->where('user_id', Auth::id())
                ->first();

            if ($dbCart) {
                foreach ($sessionCart as $item) {
                    $cartItem = CartItem::where([
                        'cart_id' => $dbCart->id,
                        'product_variant_id' => $item['product_variant_id']
                    ])->first();

                    if ($cartItem) {
                        // Cập nhật số lượng sản phẩm trong giỏ hàng
                        $newQuantity = $cartItem->quantity + $item['quantity'];
                        $cartItem->update(['quantity' => $newQuantity]);
                    } else {
                        // Thêm mới sản phẩm vào giỏ hàng
                        CartItem::create([
                            'cart_id' => $dbCart->id,
                            'product_variant_id' => $item['product_variant_id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price']
                        ]);
                    }
                }

                // Xóa giỏ hàng trong session sau khi hợp nhất
                session()->forget('cart');
            } else {
                // Nếu giỏ hàng không tồn tại trong DB, tạo mới giỏ hàng cho người dùng
                $dbCart = Cart::create(['user_id' => Auth::id()]);

                foreach ($sessionCart as $item) {
                    CartItem::create([
                        'cart_id' => $dbCart->id,
                        'product_variant_id' => $item['product_variant_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price']
                    ]);
                }

                // Xóa giỏ hàng trong session sau khi hợp nhất
                session()->forget('cart');
            }
        }
    }

    public function dashboard()
    {
        return view('client.account.dashboard');
    }
}
// dsfsdf
