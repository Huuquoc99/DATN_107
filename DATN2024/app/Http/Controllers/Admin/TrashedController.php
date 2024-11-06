<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrashedController extends Controller
{
    public function trashed()
    {
        $trashed = Product::onlyTrashed()->get();
        // return response()->json($trashed);
        return view("admin.trashed.index", compact('trashed'));

    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();

        // return response()->json(['message' => 'Product restore successful']);
        return redirect()->route('admin.trashed')->with('success', 'Product restore successful');
    }

    // public function forceDelete($id)
    // {
    //     $product = Product::withTrashed()->findOrFail($id);

    //     if ($product->img_thumbnail && Storage::disk('public')->exists($product->img_thumbnail)) {
    //         Storage::disk('public')->delete($product->img_thumbnail);
    //     }

    //     // Xoá bình luận có liên quan thông qua product_id
    //     $product->comments()->delete();

    //     $product->forceDelete();

    //     return response()->json(['message' => 'Permanently delete product successfully']);
    // }
}
