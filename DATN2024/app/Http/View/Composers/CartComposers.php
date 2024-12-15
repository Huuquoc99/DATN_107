<?php
namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\CartItem;

class CartComposers
{
    public function compose(View $view)
    {
        $cartCount = 0;

        if (Auth::check()) {
            $cartCount = CartItem::query()->where('cart_id', optional(Auth::user()->cart)->id)->count();
        } else {
            $cart = session()->get('cart', []);
            $cartCount = count($cart);
        }

        $view->with('cartCount', $cartCount);
    }
}
