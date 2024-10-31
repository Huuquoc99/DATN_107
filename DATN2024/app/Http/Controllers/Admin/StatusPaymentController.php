<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\StatusPayment;
use App\Http\Controllers\Controller;

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
    public function store(Request $request)
    {
        //
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
