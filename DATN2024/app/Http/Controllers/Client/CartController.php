<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
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
            }
        } else {
            if (!empty($sessionCart)) {
                $unifiedCart = $sessionCart;

                foreach ($sessionCart as $item) {
                    $totalAmount += $item['quantity'] * $item['price'];
                }
            } else {
                return view('client.cart', [
                    'unifiedCart' => [],
                    'totalAmount' => 0,
                    'message' => 'Không có sản phẩm nào trong giỏ hàng'
                ]);
            }
        }

        return view('client.cart', compact('unifiedCart', 'totalAmount'));

    }


    public function addToCart(AddToCartRequest $request)
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
                $cart = Cart::query()->firstOrCreate(['user_id' => Auth::id()]);
                $cartItem = CartItem::query()->where([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $productVariant->id,
                ])->first();

                if ($cartItem) {
                    $newQuantity = $cartItem->quantity + $quantity;

                    if ($newQuantity > $stock_quantity) {
                        return response()->json(['error' => 'Số lượng vượt quá hàng tồn kho.'], 422);
                    }

                    $cartItem->update(['quantity' => $newQuantity]);
                } else {
                    if ($quantity > $stock_quantity) {
                        return response()->json(['error' => 'Số lượng vượt quá hàng tồn kho.'], 422);
                    }

                    CartItem::query()->create([
                        'cart_id' => $cart->id,
                        'product_variant_id' => $productVariant->id,
                        'quantity' => $quantity,
                        'price' => $productVariant->price,
                    ]);
                }
            } else {
                $cart = session()->get('cart', []);
                $cartItemKey = $productVariant->id;

                if (isset($cart[$cartItemKey])) {
                    $newQuantity = $cart[$cartItemKey]['quantity'] + $quantity;

                    if ($newQuantity > $stock_quantity) {
                        return response()->json(['error' => 'Số lượng vượt quá hàng tồn kho.'], 422);
                    }

                    $cart[$cartItemKey]['quantity'] = $newQuantity;
                } else {
                    if ($quantity > $stock_quantity) {
                        return response()->json(['error' => 'Số lượng vượt quá hàng tồn kho.'], 422);
                    }

                    $cart[$cartItemKey] = [
                        'product_variant_id' => $productVariant->id,
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $productVariant->price,
                        'quantity' => $quantity,
                        'color' => $productVariant->color->name,
                        'capacity' => $productVariant->capacity->name,
                        'image' => $productVariant->image,
                    ];
                }
                session()->put('cart', $cart);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng.',
                'cartCount' => $this->getCartCount(), // Tính tổng số sản phẩm trong giỏ
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Đã xảy ra lỗi, vui lòng thử lại.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    private function getCartCount()
    {
        if (Auth::check()) {
            return CartItem::where('cart_id', Cart::where('user_id', Auth::id())->value('id'))->count();
        }

        $cart = session()->get('cart', []);
        return count($cart);
    }

    public function getCart()
    {
        $count = $this->getCartCount();
        return response()->json(['count' => $count]);
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

                $cartCount = CartItem::whereHas('cart', function ($query) {
                    $query->where('user_id', Auth::id());
                })->sum('quantity');
            } else {
                $cart = session()->get('cart', []);

                if (isset($cart[$id])) {
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                }

                $cartCount = array_sum(array_column(session()->get('cart', []), 'quantity'));
            }

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã bị xóa khỏi giỏ hàng.',
                'cartCount' => $cartCount,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Đã xảy ra lỗi khi xóa sản phẩm khỏi giỏ hàng.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }


    public function updateQuantity(Request $request)
    {
        try {
            $productVariantId = $request->product_variant_id;
            $quantity = $request->quantity;


            if (!$productVariantId || $quantity < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid data.'
                ], 400);
            }

            $productVariant = ProductVariant::find($productVariantId);
            if (!$productVariant) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại.'
                ], 404);
            }

            if ($quantity > $productVariant->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số lượng yêu cầu vượt quá số lượng trong kho.'
                ], 404);
            }

            if (Auth::check()) {
                $cartItem = CartItem::whereHas('cart', function ($query) {
                    $query->where('user_id', Auth::id());
                })->where('product_variant_id', $productVariantId)->first();

                if (!$cartItem) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sản phẩm không tồn tại trong giỏ hàng.'
                    ], 404);
                }

                $cartItem->update(['quantity' => $quantity]);

                $total = $this->calculateTotalForCartItem($cartItem);

            } else {
                $cart = session()->get('cart', []);
                if (isset($cart[$productVariantId])) {
                    $cart[$productVariantId]['quantity'] = $quantity;
                    session()->put('cart', $cart);

                    $total = $this->calculateTotal($cart[$productVariantId]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Không có sản phẩm trong giỏ hàng.'
                    ], 404);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Cập nhật số lượng thành công.',
                'total' => $total,
                'quantity' => $quantity
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi: ' . $e->getMessage()
            ], 500);
        }
    }



    private function calculateTotal($item)
    {
        return number_format($item['price'] * $item['quantity'], 0, ',', '.');
    }

    private function calculateTotalForCartItem($item)
    {
        return number_format($item['price'] * $item['quantity'], 0, ',', '.');
    }

}
