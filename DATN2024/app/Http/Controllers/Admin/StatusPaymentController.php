<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\StatusPayment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatusPaymentRequest;

class StatusPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listStatusPayment = StatusPayment::get();
        return response()->json( $listStatusPayment, 201);
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
    public function store(StatusPaymentRequest $request)
    {
          if ($request->isMethod("POST")) {
            $param = $request->except("_token",);
        
            StatusPayment::create($param);
        
            return response()->json(['message' => 'Status payment created successfully']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
