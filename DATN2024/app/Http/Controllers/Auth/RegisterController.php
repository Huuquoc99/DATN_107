<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
    public function showFormRegister(){
        return view('client.auth.register');
    }

    public function register()
    {
        try {
            $data = request()->validate([
                "name" => "required",
                "email" => "required|email",
                'password' => [
                    'required', 
                    'min:8', 
                    'max:20', 
                    'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/',
                    'confirmed'
                ],
            ], [
                "name.required" => "Trường tên là bắt buộc.",
                "email.required" => "Trường email là bắt buộc.",
                "email.email" => "Vui lòng cung cấp địa chỉ email hợp lệ.",
                "password.required" => "Trường mật khẩu là bắt buộc.",
                "password.min" => "Mật khẩu phải có ít nhất 8 ký tự.",
                "password.max" => "Mật khẩu không được dài hơn 20 ký tự.",
                "password.regex" => "Mật khẩu phải chứa ít nhất một chữ cái viết hoa, một chữ cái viết thường và một số.",
                "password.confirmed" => "Xác nhận mật khẩu không khớp.",
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            $token = $user->createToken($user->id)->plainTextToken;

            return redirect()->route('client.auth.register')->with('success', 'Người dùng đã đăng ký thành công.');
        } catch (\Throwable $th) {
            if ($th instanceof ValidationException) {
                return redirect()->back()->withErrors($th->errors())->withInput();
            }

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

}