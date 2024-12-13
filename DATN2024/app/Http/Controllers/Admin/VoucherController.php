<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listVoucher = Voucher::with('products')->orderBy('id', 'desc')->get();
        return view("admin.vouchers.index", compact('listVoucher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view("admin.vouchers.create", compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(VoucherRequest $request)
    // {
    //     if ($request->isMethod("POST")) {
    //         if ($request->discount_type === 'percent') {
    //             if ($request->discount < 0 || $request->discount > 5) {
    //                 return redirect()->back()
    //                     ->withErrors(['discount' => 'Mức chiết khấu phải nằm trong khoảng từ 0 đến 5 khi sử dụng phần trăm.'])
    //                     ->withInput();
    //             }
    //         } elseif ($request->discount_type === 'amount') {
    //             if ($request->discount < 0 || $request->discount > 1000000) {
    //                 return redirect()->back()
    //                     ->withErrors(['discount' => 'Mức giảm giá phải nằm trong khoảng từ 0 đến 1.000.000 khi sử dụng số tiền.'])
    //                     ->withInput();
    //             }
    //         } elseif ($request->discount_type === 'percent_max') {
    //             if ($request->max_discount < 0 || $request->max_discount  > 100) {
    //                 return redirect()->back()
    //                     ->withErrors(['discount' => 'Mức giảm giá tối đa phần trăm phải nằm trong khoảng từ 0 đến 100.'])
    //                     ->withInput();
    //             }
    //         }

    //         $voucher = Voucher::create($request->all());

    //         if ($request->has('product_ids')) {
    //             $voucher->products()->sync($request->product_ids);  
    //         }
    
    //         return redirect()->route("admin.vouchers.index")->with("success", "Voucher đã được tạo thành công");
    //     }
    // }
    
    public function store(VoucherRequest $request)
    {
        if ($request->isMethod("POST")) {
            if ($request->discount_type === 'percent') {
                if ($request->discount < 0 || $request->discount > 5) {
                    return redirect()->back()
                        ->withErrors(['discount' => 'Mức chiết khấu phải nằm trong khoảng từ 0 đến 5 khi sử dụng phần trăm.'])
                        ->withInput();
                }
            }
            elseif ($request->discount_type === 'amount') {
                if ($request->discount < 0 || $request->discount > 1000000) {
                    return redirect()->back()
                        ->withErrors(['discount' => 'Mức giảm giá phải nằm trong khoảng từ 0 đến 1.000.000 khi sử dụng số tiền.'])
                        ->withInput();
                }
            }

            elseif ($request->discount_type === 'percent_max') {
                if ($request->max_discount < 0 || $request->max_discount > 10000000) {
                    return redirect()->back()
                        ->withErrors(['max_discount' => 'Mức giảm giá tối đa phần trăm phải nằm trong khoảng từ 0 đến 1.000.000.'])
                        ->withInput();
                }
            }

            $voucher = Voucher::create($request->all());

            if ($request->has('product_ids')) {
                $voucher->products()->sync($request->product_ids);
            }

            return redirect()->route("admin.vouchers.index")->with("success", "Voucher đã được tạo thành công");
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
        
        $voucher = Voucher::findOrFail($id);
        $products = Product::all();
        return view("admin.vouchers.edit", compact("voucher", "products"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherRequest  $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            if ($request->discount_type === 'percent' && ($request->discount < 0 || $request->discount > 5)) {
                return redirect()->back()
                    ->withErrors(['discount' => 'Mức chiết khấu không được lớn hơn 5 khi sử dụng phần trăm.'])
                    ->withInput();
            } elseif ($request->discount_type === 'amount' && ($request->discount < 0 || $request->discount > 1000000)) {
                return redirect()->back()
                    ->withErrors(['discount' => 'Mức giảm giá phải nằm trong khoảng từ 0 đến 1.000.000 khi sử dụng số tiền.'])
                    ->withInput();
            }
    
            $voucher = Voucher::findOrFail($id);
            $voucher->update($request->validated());
    
            if ($request->has('product_ids')) {
                $voucher->products()->sync($request->product_ids); 
            }

            return redirect()->route("admin.vouchers.index")
                ->with("success", "Phiếu mua hàng đã được cập nhật thành công");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        return redirect()->route("admin.vouchers.index")->with("success", "Phiếu giảm giá đã xóa thành công");
    }
}
