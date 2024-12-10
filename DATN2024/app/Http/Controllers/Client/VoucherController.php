<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Voucher;
use App\Models\CartItem;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyVoucherRequest;

class VoucherController extends Controller
{
    public function index()
    {
        $catalogues = Catalogue::where('is_active', 1)->get();
        $vouchers = Voucher::query()->active()->whereColumn('used_quantity', '<', 'quantity')->get();
        // dd($vouchers);
        return view('client.vouchers', compact('catalogues','vouchers'));
    }

    // public function applyVoucher(ApplyVoucherRequest $request)
    // {
    //     session()->forget('voucher');
    //     $voucher = Voucher::query()->active()->where('code', $request->code)->first();
    //     if (!$voucher) {
    //         return response()->json(['message' => 'Mã giảm giá không tồn tại'], 404);
    //     }

    //     if ($voucher->used_quantity >= $voucher->quantity) {
    //         return response()->json(['message' => 'Mã giảm giá đã hết hạn'], 404);
    //     }
    //     session()->put('voucher', $voucher->code);
    //     return response()->json($voucher);
    // }

    public function applyVoucher(ApplyVoucherRequest $request)
    {
        session()->forget('voucher');

        $voucher = Voucher::query()->active()->where('code', $request->code)->first();

        if (!$voucher) {
            return response()->json(['message' => 'Mã giảm giá không tồn tại'], 404);
        }

        if ($voucher->used_quantity >= $voucher->quantity) {
            return response()->json(['message' => 'Mã giảm giá đã hết hạn'], 404);
        }

        $totalOrderValue = 0;

        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->first();
            if ($cart) {
                $cartItems = $cart->items; 
            } else {
                $cartItems = [];
            }
        } else {
            $cartItems = session()->get('cart', []);
        }

        foreach ($cartItems as $cartItem) {
            if (isset($cartItem['price']) && isset($cartItem['quantity'])) {
                $totalOrderValue += $cartItem['price'] * $cartItem['quantity'];
            }
        }

        if ($totalOrderValue < $voucher->min_order_value) {
            return response()->json(['message' => 'Giá trị đơn hàng không đủ để áp dụng mã giảm giá'], 400);
        }

        session()->put('voucher', $voucher->code);

        return response()->json($voucher);
    }


}
