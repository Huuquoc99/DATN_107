<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::orderBy('created_at', 'desc')->paginate(7);
        $users = User::where('type', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(7);
        return view("admin.customers.index", compact('users'));

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
        $users = User::findOrFail($id);
        if($users) {
            return view("admin.customers.show", compact('users'));

        }else{
            return response()->json(["message" => "User not found"], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        return view('admin.customers.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type' => 'required|in:0,1',
        ]);
    
        $user = User::findOrFail($id);
        $user->type = $request->type;
        $user->save();
    
        return redirect()->route('admin.customers.index')->with('success', 'User type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    
}
