<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            // Gửi đường link thay đổi mật khẩu qua email
            $status = Password::sendResetLink(
                $request->only('email')
            );

            if ($status === Password::RESET_LINK_SENT) {
                return response()->json(['message' => __($status)]);
            }

            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "errors" => $th->getMessage()
            ], 500);
        }
    }

}
