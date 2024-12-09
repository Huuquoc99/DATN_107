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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:20', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !$user->isUser()) {
            Auth::logout();
            return redirect()->back()
                ->withInput($request->only('email'))
                ->with('error', 'Bạn không có quyền truy cập trang này!');
        }


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $this->mergeSessionCartToDbCart();

            session()->flash('success', 'Đăng nhập thành công! Chào mừng trở lại: ' . Auth::user()->name . '.');

            return redirect()->intended('/');
        }

        session()->flash('error', 'Thông tin xác thực được cung cấp không khớp với hồ sơ của chúng tôi.');

        return back()->withErrors([
            'email' => 'Thông tin xác thực được cung cấp không khớp với hồ sơ của chúng tôi.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        session()->flash('success', 'Đăng xuất thành công!.');

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
