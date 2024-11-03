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
        // return response()->json( $listStatusPayment, 201);
        return view("admin.statusPayments.index", compact('listStatusPayment'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return response()->json();
        return view("admin.statusPayments.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusPaymentRequest $request)
    {
          if ($request->isMethod("POST")) {
            $param = $request->except("_token",);
            $param['is_active'] = $request->has('is_active') ? 1 : 0;
        
            $statusPayment = StatusPayment::create($param);
            $statusPayment->is_active == 0 ? $statusPayment->hide() : $statusPayment->show();
        
            // return response()->json(['message' => 'Status payment created successfully']);
            return redirect()->route("admin.statusPayments.index")->with("success", "Status payment created successfully");

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $statusPayment = StatusPayment::query()->findOrFail($id);
        // return response()->json($statusPayment);
        return view("admin.statusPayments.show", compact('statusPayment'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $statusPayment = StatusPayment::findOrFail($id);
        // return response()->json($statusPayment);
        return view("admin.statusPayments.edit", compact("statusPayment"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusPaymentRequest $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $param = $request->except("_token", "_method");
            $statusPayment = StatusPayment::findOrFail($id);
            $statusPayment->is_active = $request->has('is_active') ? 1 : 0;
        
            $statusPayment->update($param);
            $statusPayment->is_active == 0 ? $statusPayment->hide() : $statusPayment->show();

        
            // return response()->json(['message' => 'Status payment updated successfully']);
            return redirect()->route("admin.statusPayments.index")->with("success", "Status payment updated successfully");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statusPayment = StatusPayment::findOrFail($id);
        $statusPayment->delete();
        // return response()->json(['message' => 'Status payment deleted successfully']);
        return redirect()->route("admin.statusPayments.index")->with("success", "Status payment deleted successfully");

    }
}
