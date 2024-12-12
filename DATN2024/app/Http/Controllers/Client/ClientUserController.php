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
            return redirect()->route('home')->with('error', 'Bạn không có quyền chỉnh sửa thông tin này!');
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

        return redirect()->route('accountdetail', ['id' => $id])->with('success', 'Thông tin cá nhân đã được cập nhật!');
    }

    public function showChangePasswordForm()
    {
        return view('client.account.changepass');
    }

    public function changePassword(Request $request, $id)
    {
        $validated = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed|different:old_password|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
        ], [
            'old_password.required' => 'Yêu cầu nhập mật khẩu cũ.',
            'old_password.string' => 'Mật khẩu cũ phải là một chuỗi.',

            'new_password.required' => 'Yêu cầu nhập mật khẩu mới.',
            'new_password.string' => 'Mật khẩu mới phải là một chuỗi.',
            'new_password.min' => 'Mật khẩu mới phải dài ít nhất 8 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
            'new_password.different' => 'Mật khẩu mới phải khác với mật khẩu cũ.',
            'new_password.regex' => 'Mật khẩu mới phải chứa ít nhất một chữ cái viết hoa, một chữ cái viết thường và một chữ số.',
        ]);
        
        
        try {
            $user = Auth::user();
        
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->with('error', 'Mật khẩu cũ không đúng!');
            }
    
            $user->password = Hash::make($request->new_password);
            // dd($user); 
            // Lỗi thì cũng kệ nó k được xoá k được sửa
            $user->save(); 
        
            return redirect()->route('account.changePassword', ['id' => $id])->with('success', 'Mật khẩu đã được thay đổi thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Đã xảy ra lỗi không mong muốn khi cập nhật mật khẩu!');
        }
    }

    public function updateAvatar(Request $request, $id)
    {
        if (Auth::id() !== (int)$id || Auth::user()->type !== 0) {
            return redirect()->route('accountdetail')->with('error1', 'Bạn không có quyền chỉnh sửa thông tin này!');
        }

        $validated = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();
        return redirect()->route('accountdetail', ['id' => $id])->with('success1', 'Cập nhật hình đại diện thành công!');
    }


    
}
