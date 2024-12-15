<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\CartItem;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyVoucherRequest;

class VoucherController extends Controller
{
    public function index()
    {
        $catalogues = Catalogue::where('is_active', 1)->get();
        $vouchers = Voucher::query()->active()->whereColumn('used_quantity', '<', 'quantity')->get();
        // dd($vouchers);
        return view('client.vouchers', compact('catalogues', 'vouchers'));
    }

    public function applyVoucher(ApplyVoucherRequest $request)
    {
        // clear session voucher
        session()->forget('voucher');
        $voucher = Voucher::query()->active()->where('code', $request->code)->first();
        if (!$voucher) {
            return response()->json(['message' => 'Mã giảm giá không tồn tại'], 404);
        }

        if ($voucher->used_quantity >= $voucher->quantity) {
            return response()->json(['message' => 'Mã giảm giá đã hết'], 404);
        }
        session()->put('voucher', $voucher->code);
        return response()->json($voucher);
    }

    
    // Oki này
    // public function applyVoucher(ApplyVoucherRequest $request)
    // {
    //     session()->forget('voucher');
    
    //     // Lấy voucher từ mã giảm giá
    //     $voucher = Voucher::query()->active()->where('code', $request->code)->first();
    
    //     if (!$voucher) {
    //         return response()->json(['message' => 'Mã giảm giá không tồn tại'], 404);
    //     }
    
    //     if ($voucher->used_quantity >= $voucher->quantity) {
    //         return response()->json(['message' => 'Mã giảm giá đã hết hạn'], 404);
    //     }
    
    //     $totalOrderValue = 0; // Tổng giá trị đơn hàng áp dụng voucher
    //     $cartItems = []; // Mảng lưu trữ các sản phẩm trong giỏ hàng
    
    //     // Nếu người dùng đã đăng nhập
    //     if (auth()->check()) {
    //         $cart = Cart::where('user_id', auth()->id())->with('items')->first();
    //         $cartItems = $cart ? $cart->items->toArray() : [];
    //     } else {
    //         // Nếu chưa đăng nhập, lấy giỏ hàng từ session
    //         $cartItems = session()->get('cart', []);
    //     }
    
    //     logger()->info('Giỏ hàng:', $cartItems); // Log chi tiết giỏ hàng
    
    //     foreach ($cartItems as $cartItem) {
    //         // Tìm sản phẩm theo product_variant_id từ giỏ hàng
    //         $productVariant = ProductVariant::find($cartItem['product_variant_id']);
    
    //         if (!$productVariant || !$productVariant->product) {
    //             continue; // Bỏ qua nếu sản phẩm hoặc biến thể không tồn tại
    //         }
    
    //         $product = $productVariant->product; // Lấy sản phẩm liên kết từ biến thể
    
    //         // Kiểm tra nếu sản phẩm thuộc danh sách áp dụng voucher
    //         $voucherProduct = DB::table('voucher_product')
    //             ->where('voucher_id', $voucher->id)
    //             ->where('product_id', $product->id)
    //             ->exists();
    
    //         logger()->info('Thông tin sản phẩm:', [
    //             'product_id' => $product->id,
    //             'cart_price' => $cartItem['price'],
    //             'cart_quantity' => $cartItem['quantity'],
    //             'product_min_order_value' => $product->min_order_value,
    //             'voucher_applied' => $voucherProduct,
    //         ]);
    
    //         if ($voucherProduct) {
    //             $productOrderValue = $cartItem['price'] * $cartItem['quantity'];
    
    //             // Kiểm tra giá trị tối thiểu của đơn hàng cho sản phẩm này
    //             if ($productOrderValue < $product->min_order_value) {
    //                 return response()->json([
    //                     'message' => "Giá trị đơn hàng của sản phẩm '{$product->name}' không đủ để áp dụng mã giảm giá",
    //                 ], 400);
    //             }
    
    //             // Cộng dồn giá trị đơn hàng áp dụng voucher
    //             $totalOrderValue += $productOrderValue;
    //         }
    //     }
    
    //     // Log giá trị tổng và giá trị tối thiểu của voucher
    //     logger()->info('Kiểm tra giá trị từ DB:', [
    //         'voucher_min_order_value' => $voucher->min_order_value,
    //         'totalOrderValue_calculated' => $totalOrderValue,
    //     ]);
    
    //     // Kiểm tra nếu tổng giá trị đơn hàng không đủ để áp dụng voucher
    //     if ($totalOrderValue < $voucher->min_order_value) {
    //         return response()->json([
    //             'message' => 'Giá trị đơn hàng không đủ để áp dụng mã giảm giá',
    //             'totalOrderValue' => $totalOrderValue,
    //             'requiredValue' => $voucher->min_order_value,
    //         ], 400);
    //     }
    
    //     // Lưu voucher vào session
    //     session()->put('voucher', $voucher->code);
    
    //     return response()->json([
    //         'message' => 'Mã giảm giá đã được áp dụng thành công',
    //         'voucher' => $voucher,
    //         'totalOrderValue' => $totalOrderValue,
    //     ]);
    // }
    
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

    //     $totalOrderValue = 0; 
    //     $cartItems = [];

    //     if (auth()->check()) {
    //         $cart = Cart::where('user_id', auth()->id())->with('items')->first();
    //         $cartItems = $cart ? $cart->items->toArray() : [];
    //     } else {
    //         $cartItems = session()->get('cart', []);
    //     }

    //     logger()->info('Giỏ hàng:', $cartItems); 

    //     $eligibleForVoucher = false;

    //     foreach ($cartItems as $cartItem) {
    //         $productVariant = ProductVariant::find($cartItem['product_variant_id']);

    //         if (!$productVariant || !$productVariant->product) {
    //             continue;
    //         }

    //         $product = $productVariant->product;

    //         $voucherProduct = DB::table('voucher_product')
    //             ->where('voucher_id', $voucher->id)
    //             ->where('product_id', $product->id)
    //             ->exists();

    //         logger()->info('Thông tin sản phẩm:', [
    //             'product_id' => $product->id,
    //             'cart_price' => $cartItem['price'],
    //             'cart_quantity' => $cartItem['quantity'],
    //             'product_min_order_value' => $product->min_order_value,
    //             'voucher_applied' => $voucherProduct,
    //         ]);

    //         if ($voucherProduct) {
    //             $productOrderValue = $cartItem['price'] * $cartItem['quantity'];

    //             if ($productOrderValue < $product->min_order_value) {
    //                 return response()->json([
    //                     'message' => "Giá trị đơn hàng của sản phẩm '{$product->name}' không đủ để áp dụng mã giảm giá",
    //                 ], 400);
    //             }

    //             $totalOrderValue += $productOrderValue;
    //             $eligibleForVoucher = true;
    //         }
    //     }

    //     logger()->info('Kiểm tra giá trị từ DB:', [
    //         'voucher_min_order_value' => $voucher->min_order_value,
    //         'totalOrderValue_calculated' => $totalOrderValue,
    //     ]);

    //     if (!$eligibleForVoucher) {
    //         return response()->json([
    //             'message' => 'Sản phẩm không đủ điều kiện để áp dụng mã giảm giá',
    //         ], 400);
    //     }

    //     if ($totalOrderValue < $voucher->min_order_value) {
    //         return response()->json([
    //             'message' => 'Giá trị đơn hàng không đủ để áp dụng mã giảm giá',
    //             'totalOrderValue' => $totalOrderValue,
    //             'requiredValue' => $voucher->min_order_value,
    //         ], 400);
    //     }

    //     session()->put('voucher', $voucher->code);

    //     return response()->json([
    //         'message' => 'Mã giảm giá đã được áp dụng thành công',
    //         'voucher' => $voucher,
    //         'totalOrderValue' => $totalOrderValue,
    //     ]);
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

        $clientIP = $request->ip();
        $voucherUsedByIP = DB::table('voucher_usage')
            ->where('voucher_code', $voucher->code)
            ->where('ip_address', $clientIP)
            ->exists();

        if ($voucherUsedByIP) {
            return response()->json([
                'message' => 'IP của bạn đã sử dụng mã giảm giá này',
            ], 400);
        }

        $totalOrderValue = 0;
        $cartItems = [];

        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->with('items')->first();
            $cartItems = $cart ? $cart->items->toArray() : [];
        } else {
            $cartItems = session()->get('cart', []);
        }

        logger()->info('Giỏ hàng:', $cartItems);

        $eligibleForVoucher = false;

        foreach ($cartItems as $cartItem) {
            $productVariant = ProductVariant::find($cartItem['product_variant_id']);

            if (!$productVariant || !$productVariant->product) {
                continue;
            }

            $product = $productVariant->product;

            $voucherProduct = DB::table('voucher_product')
                ->where('voucher_id', $voucher->id)
                ->where('product_id', $product->id)
                ->exists();

            logger()->info('Thông tin sản phẩm:', [
                'product_id' => $product->id,
                'cart_price' => $cartItem['price'],
                'cart_quantity' => $cartItem['quantity'],
                'product_min_order_value' => $product->min_order_value,
                'voucher_applied' => $voucherProduct,
            ]);

            if ($voucherProduct) {
                $productOrderValue = $cartItem['price'] * $cartItem['quantity'];

                if ($productOrderValue < $product->min_order_value) {
                    return response()->json([
                        'message' => "Giá trị đơn hàng của sản phẩm '{$product->name}' không đủ để áp dụng mã giảm giá",
                    ], 400);
                }

                $totalOrderValue += $productOrderValue;
                $eligibleForVoucher = true;
            }
        }

        logger()->info('Kiểm tra giá trị từ DB:', [
            'voucher_min_order_value' => $voucher->min_order_value,
            'totalOrderValue_calculated' => $totalOrderValue,
        ]);

        if (!$eligibleForVoucher) {
            return response()->json([
                'message' => 'Sản phẩm không đủ điều kiện để áp dụng mã giảm giá',
            ], 400);
        }

        if ($totalOrderValue < $voucher->min_order_value) {
            return response()->json([
                'message' => 'Giá trị đơn hàng không đủ để áp dụng mã giảm giá',
                'totalOrderValue' => $totalOrderValue,
                'requiredValue' => $voucher->min_order_value,
            ], 400);
        }

        DB::table('voucher_usage')->insert([
            'voucher_code' => $voucher->code,
            'ip_address' => $clientIP,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->put('voucher', $voucher->code);

        return response()->json([
            'message' => 'Mã giảm giá đã được áp dụng thành công',
            'voucher' => $voucher,
            'totalOrderValue' => $totalOrderValue,
        ]);
    }

    
    



    
    
    

    
}
