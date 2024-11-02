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
        // return response()->json( $listPaymentMethod, 201);
        return view("admin.paymentMethods.index", compact('listPaymentMethod'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return response()->json();
        return view("admin.paymentMethods.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentMethodRequest $request)
    {
        if ($request->isMethod("POST")) {
            $param = $request->except("_token",);
        
            PaymentMethod::create($param);
        
            // return response()->json(['message' => 'Payment method created successfully']);
            return redirect()->route("admin.paymentMethods.index")->with("success", "Payment method created successfully");

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymentMethod = PaymentMethod::query()->findOrFail($id);
        // return response()->json($paymentMethod);
        return view("admin.paymentMethods.show", compact('paymentMethod'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        // return response()->json($paymentMethod);
        return view("admin.paymentMethods.edit", compact("paymentMethod"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentMethodRequest $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $param = $request->except("_token", "_method");
            $paymentMethod = PaymentMethod::findOrFail($id);
        
            $paymentMethod->update($param);
        
            if ($paymentMethod->is_active == 0) {
                $paymentMethod->hide();
            } else {
                $paymentMethod->show();
            }
        
            return response()->json(['message' => 'Payment method updated successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        $paymentMethod->delete();
        return response()->json(['message' => 'Payment method deleted successfully']);
    }
}
