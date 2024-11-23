<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TrashedController extends Controller
{
    public function trashed()
    {

        $trashed = Product::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(5);

        return view("admin.trashed.index", compact('trashed'));
    }

    public function restore($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $product = Product::withTrashed()->findOrFail($id);

                $product->restore();

                $product->galleries()->withTrashed()->restore();
                foreach ($product->variants()->withTrashed()->get() as $variant) {
                    $variant->restore();
                    $variant->orderItems()->withTrashed()->restore();
                }
            }, 3);

            return redirect()->route('admin.products.index')
                ->with('success', 'Product restored successfully!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }
}
