<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cartList()
    {
//        dd(session('cart'));
        $totalAmount = 0;
        $unifiedCart = [];
        $sessionCart = session('cart');


        if (Auth::check()) {
            $dbCart = Cart::with(['items.productVariant.product'])
                ->where('user_id', Auth::id())
                ->first();

            if ($dbCart) {
                foreach ($dbCart->items as $item) {
                    $product = $item->productVariant->product;
                    $productVariant = $item->productVariant;

                    $unifiedCart[$productVariant->id] = [
                        'product_variant_id' => $productVariant->id,
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $productVariant->price,
                        'quantity' => $item->quantity,
                        'color' => $productVariant->color->name,
                        'capacity' => $productVariant->capacity->name,
                        'image' => $productVariant->image
                    ];

                    $totalAmount += $item->quantity * ($product->price_sale ?? $product->price);
                }
                if (!empty($sessionCart)) {

                    foreach ($sessionCart as $item) {

                        $cartItem = CartItem::query()->where([
                            'cart_id' => $dbCart->id,
                            'product_variant_id' => $item['product_variant_id']
                        ])->first();
                        if ($cartItem) {
                            $newQuantity = $cartItem->quantity + $item['quantity'];
                            $cartItem->update(['quantity' => $newQuantity]);

                            if (isset($unifiedCart[$item['product_variant_id']])) {
                                $unifiedCart[$item['product_variant_id']]['quantity'] = $newQuantity;
                            }
                        } else {
                            $newCartItem = CartItem::query()->create([
                                'cart_id' => $dbCart->id,
                                'product_variant_id' => $item['product_variant_id'],
                                'quantity' => $item['quantity'],
                                'price' => $item['price']
                            ]);

                            $unifiedCart[$item['product_variant_id']] = [
                                'product_variant_id' => $newCartItem->product_variant_id,
                                'quantity' => $newCartItem->quantity,
                                'price' => $newCartItem->price,
                            ];
                        }

                        // Tính tổng giá
                        $totalAmount = $item['quantity'] * $item['price'];
                    }
                    // Xóa session sau khi đã lưu vào db
                    session()->forget('cart');
                }
            } else {
                dd($sessionCart);
                if (!empty($sessionCart)) {
                    $dbCart = Cart::query()->create([
                        'user_id' => Auth::id()
                    ]);

                    foreach ($sessionCart as $item) {
                        CartItem::query()->create([
                            'cart_id' => $dbCart->id,
                            'product_variant_id' => $item['product_variant_id'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price']
                        ]);

                        $unifiedCart[$item['product_variant_id']] = $item;
                        $totalAmount = $item['quantity'] * $item['price'];
                    }

                    session()->forget('cart');
                }
            }
        } else {
            $unifiedCart = $sessionCart;
            foreach ($sessionCart as $item) {
                $totalAmount += $item['quantity'] * $item['price'];
            }
        }

        return view('client.cart', compact('unifiedCart', 'totalAmount'));

    }


    public function addToCart(Request $request)
    {
        try {
            DB::beginTransaction();

            $product = Product::query()->findOrFail($request->product_id);
            $productVariant = ProductVariant::query()
                ->with(['color', 'capacity'])
                ->where([
                    'product_id' => $request->product_id,
                    'product_capacity_id' => $request->product_capacity_id,
                    'product_color_id' => $request->product_color_id,
                ])
                ->firstOrFail();

            $quantity = (int) $request->input('quantity', 0);

            $stock_quantity = $productVariant->quantity;

            if (Auth::check()) {
                $cart = Cart::query()->firstOrCreate([
                    'user_id' => Auth::id()
                ]);

                $cartItem = CartItem::query()->where([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $productVariant->id
                ])->first();


                if (!$cartItem) {
                    if ($quantity > $stock_quantity) {
                        return response()->json([
                            'error' => 'Vượt quá số lượng cho phép'
                        ], 400);
                    }

                    CartItem::query()->create([
                        'cart_id' => $cart->id,
                        'product_variant_id' => $productVariant->id,
                        'quantity' => $quantity,
                        'price' => $productVariant->price
                    ]);
                }

            } else {
                $cart = session()->get('cart', []);
                $cartItemKey = $productVariant->id;

                if (isset($cart[$cartItemKey])) {
                    $newQuantity = $cart[$cartItemKey]['quantity'] + $quantity;

                    if ($newQuantity > $stock_quantity) {
                        return response()->json([
                            'error' => 'Vượt quá số lượng cho phép'
                        ], 400);
                    }

                    $cart[$cartItemKey]['quantity'] = $newQuantity;
                } else {
                    if ($quantity > $stock_quantity) {
                        return response()->json([
                            'error' => 'Vượt quá số lượng cho phép'
                        ], 400);
                    }

                    $cart[$cartItemKey] = [
                        'product_variant_id' => $productVariant->id,
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $productVariant->price,
                        'quantity' => $quantity,
                        'color' => $productVariant->color->name,
                        'capacity' => $productVariant->capacity->name,
                        'image' => $productVariant->image
                    ];
                }
                session()->put('cart', $cart);
            }

            DB::commit();

        return redirect()->route('cart.list');

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Có lỗi xảy ra, vui lòng thử lại',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteCart(Request $request)
    {
        $id = $request->input('deleteId');
        try {
            if (Auth::check()) {
                $cartItem = CartItem::whereHas('cart', function ($query) {
                    $query->where('user_id', Auth::id());
                })->where('product_variant_id', $id)->first();

                if ($cartItem) {
                    $cartItem->delete();
                }
            } else {

                $cart = session()->get('cart', []);

                if (isset($cart[$id])) {
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                }
            }

            return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa sản phẩm khỏi giỏ hàng.');
        }
    }

    public function updateCart(Request $request)
    {
        $cartData = $request->input('cart', []);

        try {
            foreach ($cartData as $productVariantId => $quantity) {
                $productVariant = ProductVariant::query()->with('product')->findOrFail($productVariantId);
                $product = $productVariant->product;

                $stockQuantity = $productVariant->quantity;

                if ($quantity > $stockQuantity) {
                    return response()->json([
                        'success' => false,
                        'message' => "Sản phẩm: {$product->name} - {$productVariant->color->name} - {$productVariant->capacity->name} trong kho không đủ, vui lòng thử lại!",
                    ], 400);
                }

                if ($quantity <= 0) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Số lượng là phải lớn hơn hoặc bằng 1.'
                    ], 400);
                }

                if (Auth::check()) {
                    $cart = Cart::query()->where('user_id', Auth::id())->first();
                    if ($cart) {
                        $cartItem = CartItem::query()
                            ->where('cart_id', $cart->id)
                            ->where('product_variant_id', $productVariantId)
                            ->first();
                        $cartItem->update(['quantity' => $quantity]);
                    }
                } else {
                    $sessionCart = session()->get('cart', []);
                    if (isset($sessionCart[$productVariantId])) {
                        $sessionCart[$productVariantId]['quantity'] = $quantity;
                    } else {
                        $sessionCart[$productVariantId] = ['quantity' => $quantity];
                    }

                    session()->put('cart', $sessionCart);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Giỏ hàng đã được cập nhật thành công.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'details' => $e->getMessage()
            ], 500);
        }
    }



}
