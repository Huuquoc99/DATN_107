<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AccountController extends Controller
{
    public function edit($id)
    {
        if (Auth::id() !== (int)$id || Auth::user()->type !== 1) {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to edit this information!');
        }

        $user = User::findOrFail($id);

        return view('admin.account.edit', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        if (Auth::id() !== (int)$id || Auth::user()->type !== 1) {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to edit this information!');
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

        return redirect()->route('admin.account.edit', ['id' => $id])->with('success', 'Personal information has been updated!');
    }



    public function updateAvatar(Request $request, $id)
    {
        if (Auth::id() !== (int)$id || Auth::user()->type !== 1) {
            return redirect()->route('admin.dashboard')->with('error', 'Bạn không có quyền chỉnh sửa thông tin này!');
        }

        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
                Storage::delete('public/' . $user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();

        return redirect()->route('admin.account.edit', ['id' => $id]);
    }


    public function changePassword(Request $request, $id)
    {
        $validated = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed|different:old_password', 
        ]);
    
        try {
            $user = Auth::user();
        
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->with('error1', 'Old password is incorrect!');
            }
    
            $user->password = Hash::make($request->new_password);
            // dd($user); 
            // Lỗi thì cũng kệ nó k được xoá k được sửa
            $user->save(); 
        
            return redirect()->route('admin.account.edit', ['id' => $id])->with('success1', 'Password has been changed successfully!');
        } catch (\Exception $e) {
            return back()->with('error1', 'An unexpected error occurred while updating the password!');
        }
    }
    
    

}
