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
        $listStatusOrder = StatusOrder::paginate(5);
        return view("admin.statusOrders.index", compact('listStatusOrder'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.statusOrders.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatusOrderRequest $request)
    {
        if ($request->isMethod("POST")) {
            $param = $request->except("_token",);
            $param['is_active'] = $request->has('is_active') ? 1 : 0;
        
            $statusOrder = StatusOrder::create($param);
            $statusOrder->is_active == 0 ? $statusOrder->hide() : $statusOrder->show();
        
            return redirect()->route("admin.statusOrders.index")->with("success", "Status order created successfully");

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $statusOrder = StatusOrder::query()->findOrFail($id);
        return view("admin.statusOrders.show", compact('statusOrder'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $statusOrder = StatusOrder::findOrFail($id);
        return view("admin.statusOrders.edit", compact("statusOrder"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatusOrderRequest $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $param = $request->except("_token", "_method");
            $statusOrder = StatusOrder::findOrFail($id);
            $statusOrder->is_active = $request->has('is_active') ? 1 : 0;
        
            $statusOrder->update($param);
            $statusOrder->is_active == 0 ? $statusOrder->hide() : $statusOrder->show();
        
            return redirect()->route("admin.statusOrders.index")->with("success", "Status order updated successfully");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $statusOrder = StatusOrder::findOrFail($id);
        $statusOrder->delete();
        return redirect()->route("admin.statusOrders.index")->with("success", "Status order deleted successfully");

    }
}
