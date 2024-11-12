<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
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
}
