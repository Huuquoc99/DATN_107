<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductColorRequest;

class ProductColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listProductColor = ProductColor::all();
        // return response()->json($listProductColor, 200);
        return view("admin.productColors.index", compact('listProductColor'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return response()->json();
        return view("admin.productColors.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductColorRequest $request)
    {
        if ($request->isMethod("POST")) {
            $param = $request->except("_token");

            $param['is_active'] = $request->has('is_active') ? 1 : 0;
        
            $productColor = ProductColor::create($param);
            $productColor->is_active == 0 ? $productColor->hide() : $productColor->show();
        
            // return response()->json(['message' => 'Product Color created successfully']);
            return redirect()->route("admin.productColors.index")->with("success", "Product color created successfully");

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productColor = ProductColor::query()->findOrFail($id);
        // return response()->json($productColor);
        return view("admin.productColors.show", compact('productColor'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productColor = ProductColor::findOrFail($id);
        // return response()->json($productColor);
        return view("admin.productColors.edit", compact("productColor"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductColorRequest $request, string $id)
    {
        $param = $request->except("_token", "_method");
    
        $productColor = ProductColor::findOrFail($id);
        $productColor->is_active = $request->has('is_active') ? 1 : 0;

        $productColor->update($param);
        $productColor->is_active == 0 ? $productColor->hide() : $productColor->show();
    
        // return response()->json([
        //     'message' => 'Product Color updated successfully',
        //     'data' => $productColor
        // ]);

        return redirect()->route("admin.productColors.index")->with("success", "Product Color updated successfully");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductVariant::query()->where("product_color_id", $id)->delete();
        $productColor = ProductColor::query()->findOrFail($id);
        $productColor->delete();
        // return response()->json(['message' => 'Product Color deleted successfully']);
        return redirect()->route("admin.productColors.index")->with("success", "Product Color deleted successfully");

    }
}
