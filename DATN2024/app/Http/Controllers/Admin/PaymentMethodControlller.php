<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listPaymentMethod = PaymentMethod::get();
        return response()->json( $listPaymentMethod, 201);
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
    public function store(PaymentMethodRequest $request)
    {
        if ($request->isMethod("POST")) {
            $param = $request->except("_token",);
        
            PaymentMethod::create($param);
        
            return response()->json(['message' => 'Payment method created successfully']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymentMethod = PaymentMethod::query()->findOrFail($id);
        return response()->json($paymentMethod);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
