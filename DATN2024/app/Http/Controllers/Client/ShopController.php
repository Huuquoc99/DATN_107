<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function listProduct()
    {
        $product = Product::where('is_active', 1)->with("catalogue")->get();
        $catalogue = Catalogue::where('is_active', 1)->get();

        return response()->json([
            'data' => [
                'product' => $product,
                'catalogue' => $catalogue,
            ],
            'message' => 'Danh sách các sản phẩm thành công.',
        ]);
    }

    public function listProductsByCategory($id)
    {
        $catalogue = Catalogue::find($id);

        if (!$catalogue) {
            return response()->json(['error' => 'Danh mục không tồn tại.'], 404);
        }

        $product = Product::where('catalogue_id', $id)
                        ->where('is_active', 1)
                        ->paginate(9);

        return response()->json([
            'data' => $product,
            'message' => 'Danh sách sản phẩm theo danh mục thành công.',
        ]);
    }
}
