<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\ProductCapacity;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCapacityRequest;

class ProductCapacityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listProductCapacity = ProductCapacity::paginate(5);
        // return response()->json($listProductCapacity, 200);
        return view("admin.productCapacities.index", compact('listProductCapacity'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return response()->json();
        return view("admin.productCapacities.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCapacityRequest $request)
    {
        if ($request->isMethod("POST")) {
            $param = $request->except("_token");
        
         
            $param['is_active'] = $request->has('is_active') ? 1 : 0;
            $productCapacity = ProductCapacity::create($param);
            $productCapacity->is_active == 0 ? $productCapacity->hide() : $productCapacity->show();

            // return response()->json(['message' => 'Product Capacity created successfully']);
            return redirect()->route("admin.productCapacities.index")->with("success", "Product Capacity created successfully");

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productCapacity = ProductCapacity::query()->findOrFail($id);
        // return response()->json($productCapacity);
        return view("admin.productCapacities.show", compact('productCapacity'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productCapacity = ProductCapacity::findOrFail($id);
        // return response()->json($productCapacity);
        return view("admin.productCapacities.edit", compact("productCapacity"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCapacityRequest $request, string $id)
    {
        $param = $request->except("_token", "_method");
    
        $productCapacity = ProductCapacity::findOrFail($id);
        $productCapacity->is_active = $request->has('is_active') ? 1 : 0;
        $productCapacity->update($param);
        $productCapacity->is_active == 0 ? $productCapacity->hide() : $productCapacity->show();
    
        // return response()->json([
        //     'message' => 'Product Capacity updated successfully',
        //     'data' => $productCapacity
        // ]);

        return redirect()->route("admin.productCapacities.index")->with("success", "Product Capacity updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductVariant::query()->where("product_color_id", $id)->delete();
        $productCapacity = ProductCapacity::query()->findOrFail($id);
        $productCapacity->delete();
        // return response()->json(['message' => 'Product Capacity deleted successfully']);
        return redirect()->route("admin.productCapacities.index")->with("success", "Product Capacity deleted successfully");

    }
}
// sád
