<?php

namespace App\Http\Controllers\Admin;

use App\Models\StatusOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatusOrderRequest;

class StatusOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listStatusOrder = StatusOrder::get();
        return response()->json( $listStatusOrder, 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusOrderRequest $request)
    {
        if ($request->isMethod("POST")) {
            $param = $request->except("_token",);
        
            StatusOrder::create($param);
        
            return response()->json(['message' => 'Status order created successfully']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $statusOrder = StatusOrder::query()->findOrFail($id);
        return response()->json($statusOrder);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $statusOrder = StatusOrder::findOrFail($id);
        return response()->json($statusOrder);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
