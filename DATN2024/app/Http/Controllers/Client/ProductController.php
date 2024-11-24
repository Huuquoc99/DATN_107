<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCapacity;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Comment;

class ProductController extends Controller
{
    public function productDetail($slug)
    {

        $product = Product::query()->with(['variants.capacity','variants.color','galleries'])->where('slug', $slug)->first();

        $colors = ProductColor::query()
            ->select('id', 'name', 'color_code')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => [
                    'name' => $item->name,
                    'color_code' => $item->color_code
                ]];
            })
            ->all();
           
         
        
        
        $productId = $product->id;    
        $comments = Comment::where('product_id', $productId)->paginate(5);

        $capacities = ProductCapacity::query()->pluck('name', 'id')->all();

        $relatedProducts = Product::query()
            ->where('catalogue_id', $product->catalogue_id) 
            ->where('id', '!=', $product->id) 
            ->get(); 
        // dd($comments);

        return view('client.product-detail', compact('product','capacities','colors','comments', 'relatedProducts'));
    }

    public function getVariantDetails(Request $request)
    {
        $variant = ProductVariant::query()->where([
            ['product_id', $request->product_id],
            ['product_color_id', $request->product_color_id],
            ['product_capacity_id', $request->product_capacity_id],
        ])->first();

        if ($variant) {
            return response()->json([
                'price' => number_format($variant->price, 0, ',', '.') ,
                'quantity' => $variant->quantity > 0 // true nếu quantity > 0, ngược lại là false
            ]);
        } else {
            return response()->json(['price' => null, 'quantity' => false]);
        }
    }

    public function checkStock($productId, $colorId, $capacityId)
    {
        $product = Product::with(['variants'])->find($productId);

        $variant = $product->variants()->where('product_color_id', $colorId)->where('product_capacity_id', $capacityId)->first();

        if ($variant) {
            return response()->json(['quantity' => $variant->quantity]);
        } else {
            return response()->json(['quantity' => 0]); // Nếu không tìm thấy biến thể
        }
    }

}
