<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCapacity;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetail($slug)
    {

        $product = Product::query()->with(['variants','galleries'])->where('slug', $slug)->first();


        $colors = ProductColor::select('id', 'name', 'color_code')->get();
        $capacities = ProductCapacity::query()->pluck('name', 'id')->all();

        foreach ($product->galleries as $image) {

        }
        return view('client.product-detail', compact('product','colors','capacities'));
    }
}
