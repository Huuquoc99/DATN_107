<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function changePassword(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'old_password' => 'required|string',
        //     'new_password' => 'required|string|min:8|confirmed|different:old_password|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', 
        // ]);
    

        $validated = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed|different:old_password|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
        ], [
            'old_password.required' => 'Old password is required.',
            'old_password.string' => 'Old password must be a string.',
            
            'new_password.required' => 'New password is required.',
            'new_password.string' => 'New password must be a string.',
            'new_password.min' => 'New password must be at least 8 characters long.',
            'new_password.confirmed' => 'New password confirmation does not match.',
            'new_password.different' => 'New password must be different from old password.',
            'new_password.regex' => 'New password must contain at least one uppercase letter, one lowercase letter, and one digit.',
        ]);
        
        
        try {
            $user = Auth::user();
        
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->with('error', 'Old password is incorrect!');
            }
    
            $user->password = Hash::make($request->new_password);
            // dd($user); 
            // Lỗi thì cũng kệ nó k được xoá k được sửa
            $user->save(); 
        
            return redirect()->route('account.changePassword', ['id' => $id])->with('success', 'Password has been changed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred while updating the password!');
        }
    }

    public function updateAvatar(Request $request, $id)
    {
        if (Auth::id() !== (int)$id || Auth::user()->type !== 0) {
            return redirect()->route('accountdetail')->with('error1', 'You do not have permission to edit this information!');
        }

        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            // if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
            //     Storage::delete('public/' . $user->avatar);
            // }

            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();
        return redirect()->route('accountdetail', ['id' => $id])->with('success1', 'Avatar update successful!');
    }


    
}
