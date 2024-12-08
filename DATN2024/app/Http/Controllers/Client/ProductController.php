<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductCapacity;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use App\Traits\UserFavorites;
use Illuminate\Http\Request;
use App\Models\Comment;

class ProductController extends Controller
{
    use UserFavorites;

    public function productDetail(Request $request, $slug)
    {
        $product = Product::query()
            ->with([
                'variants.capacity',
                'variants.color',
                'galleries' => function ($query) {
                    $query->take(4);
                },
            ])
            ->where('slug', $slug)
            ->first();

        $colors = $product->variants
            ->unique('color.id')
            ->mapWithKeys(function ($variant) {
                return [
                    $variant->color->id => [
                        'name' => $variant->color->name,
                        'color_code' => $variant->color->color_code
                    ]
                ];
            });

        $capacities = $product->variants
            ->unique('capacity.id')
            ->mapWithKeys(function ($variant) {
                return [
                    $variant->capacity->id => $variant->capacity->name
                ];
            });
        $productId = $product->id;
        $favoriteProductIds = $this->getUserFavorites()['favoriteProductIds'];
        $comments = Comment::where('product_id', $productId)->paginate(5);

        $user = auth()->user();
        $canRate = false;

        if ($user) {
            $firstVariant = $product->variants->first();

            $canRate = $this->canRateProduct($firstVariant->id, $user->id);
        }

        $relatedProducts = Product::query()
            ->where('catalogue_id', $product->catalogue_id)
            ->where('id', '!=', $product->id)
            ->get();

        if (!$request->session()->has('viewed_article_'.$product->id)) {
            $product->increment('views');
            $request->session()->put('viewed_article_'.$product->id, true);
        }


        return view('client.product-detail',
            compact('product',
                'capacities',
                'colors',
                'comments',
                'relatedProducts',
                'favoriteProductIds',
                'canRate'));
    }

    public function canRateProduct($productVariantId, $userId) {

        $orderItemQuery = OrderItem::query()->where('product_variant_id', $productVariantId)
            ->get();

        $ordersWithUser = Order::query()->where('user_id', $userId)
            ->where('status_order_id', 5)
            ->get();

        $orderItem = OrderItem::where('product_variant_id', $productVariantId)
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('status_order_id', 5);
            })
            ->exists();

        return $orderItem;
    }


    public function getVariantDetails(Request $request)
    {
        $variant = ProductVariant::query()->where([
            ['product_id',          $request->product_id],
            ['product_color_id',    $request->product_color_id],
            ['product_capacity_id', $request->product_capacity_id],
        ])->first();

        if ($variant) {
            return response()->json([
                'price'     => number_format($variant->price, 0, ',', '.') ,
                'quantity'  => $variant->quantity > 0 // true nếu quantity > 0, ngược lại là false
            ]);
        } else {
            return response()->json(['price' => null, 'quantity' => false]);
        }
    }

    public function checkStock($productId, $colorId, $capacityId)
    {
        $product = Product::with(['variants'])->find($productId);

        $variant = $product->variants()->where('product_color_id', $colorId)
                                       ->where('product_capacity_id', $capacityId)
                                       ->first();

        if ($variant) {
            return response()->json(['quantity' => $variant->quantity]);
        } else {
            return response()->json(['quantity' => 0]); // Nếu không tìm thấy biến thể
        }
    }

}
