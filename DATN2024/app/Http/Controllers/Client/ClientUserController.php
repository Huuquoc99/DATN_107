<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientUserController extends Controller
{

    public function accountDetail()
    {
        $user = Auth::user();
        return view('client.account.accountdetails', compact('user'));
    }

    public function updateProfile(Request $request, string $id)
    {

        if (Auth::id() !== (int)$id || Auth::user()->type !== 0) {
            return redirect()->route('home')->with('error', 'You do not have permission to edit this information!');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:10|min:10',
        ]);

        $user = User::findOrFail($id);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('address')) {
            $user->address = $request->address;
        }

        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        if ($user->isDirty()) {
            $user->save();  
        }

        return redirect()->route('accountdetail', ['id' => $id])->with('success', 'Personal information has been updated!');
    }

    public function showChangePasswordForm()
    {
        return view('client.account.changepass');
    }

    public function updatePassword(Request $request, string $id)
    {
        $validatedData = $request->validate([
            "password" => "required|string|min:8|confirmed", 
        ]);

        if ($request->isMethod("PUT")) {
            $user = User::findOrFail($id);
            $param['password'] = bcrypt($validatedData['password']); 

            $user->update($param);

            return response()->json(['message' => 'Password updated successfully']);
        }

        return response()->json(['message' => 'Invalid request method'], 405);
    }
    
}
