<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Notifications\CustomResetPasswordNotification;
use App\Notifications\CustomResetPasswordNotificationForClient;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('client.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Password::getRepository()->create($user);

            $user->notify(new CustomResetPasswordNotificationForClient($token));

            return back()->with('status', 'Chúng tôi đã gửi email liên kết đặt lại mật khẩu của bạn!');
        }

        return back()->withErrors(['email' => 'Không tìm thấy người dùng nào có địa chỉ email này.']);
    }

}
