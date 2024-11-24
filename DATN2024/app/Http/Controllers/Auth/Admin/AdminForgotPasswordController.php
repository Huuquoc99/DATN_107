<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Notifications\CustomResetPasswordNotification;

class AdminForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('admin.auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Password::getRepository()->create($user);

            $user->notify(new CustomResetPasswordNotification($token));
            // dd(session()->all());
            return view('admin.auth.passwords.email')->with([
                'email', $request->email,
                'status' => 'We have emailed your password reset link!',
            ]);
        }

        return back()->withErrors(['email' => 'No user found with this email address.']);
    }


    public function showResetForm($token)
    {
        return view('admin.auth.passwords.reset')->with(['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('admin.login')->with('status', trans($response));
        }

        return back()->withErrors(['email' => trans($response)]);
    }
}
