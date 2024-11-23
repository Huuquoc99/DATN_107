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
            // dd(session()->all());
            return view('client.auth.passwords.email')->with([
                'email', $request->email,
                'status' => 'We have emailed your password reset link!',
            ]);
        }

        return back()->withErrors(['email' => 'No user found with this email address.']);
    }
}
