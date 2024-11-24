<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listVoucher = Voucher::get();
        return view("admin.vouchers.index", compact('listVoucher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.vouchers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherRequest $request)
    {
        if ($request->isMethod("POST")) {
            Voucher::create($request->all());
            return redirect()->route("admin.vouchers.index")->with("success", "Voucher created successfully");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        return view("admin.vouchers.edit", compact("voucher"));
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
    public function update(VoucherRequest $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $voucher = Voucher::findOrFail($id);
            $voucher->update($request->all());
            return redirect()->route("admin.vouchers.index")->with("success", "Voucher updated successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        return redirect()->route("admin.vouchers.index")->with("success", "Voucher deleted successfully");
    }
}
