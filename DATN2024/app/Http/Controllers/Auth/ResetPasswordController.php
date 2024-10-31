<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'token' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);

            // Đặt lại mật khẩu
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->save();
                }
            );

            if ($status == Password::PASSWORD_RESET) {
                return response()->json(['message' => __($status)]);
            }

            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "errors" => $th->getMessage()
            ], 500);
        };


    }

    public function showResetForm(Request $request, $token = null)
    {
        return response()->json(['token' => $token]);
    }
}
