<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
       // Đăng nhập
    // public function login()
    // {
    //     try {
    //         request()->validate([
    //             "email" => "required|email",
    //             "password" => "required",
    //         ]);
    
    //         $user = User::where("email", request("email"))->first();
    
    //         if(!$user || !Hash::check(request("password"), $user->password)){
    //             throw ValidationException::withMessages([
    //                 "email" => ["The provided credentials are incorrect"],
    //             ]);
    //         }
    //         $token = $user->createToken($user->id)->plainTextToken;
    
    //         // return response()->json([
    //         //     "token" => $token
    //         // ]);

    //         // Phân quyền người dùng
    //         if ($user->type == 1) {
    //             // Nếu là admin
    //             return response()->json([
    //                 "token" => $token,
    //                 "role" => "admin",
    //                 "redirect" => "/admin/dashboard"
    //             ], Response::HTTP_OK);
    //         } else {
    //             // Nếu là user thông thường
    //             return response()->json([
    //                 "token" => $token,
    //                 "role" => "client",
    //                 "redirect" => "/client/home" 
    //             ], Response::HTTP_OK);
    //         }
    //         //

    //     } catch (\Throwable $th) {
    //         if($th instanceof ValidationException){
    //             return response()->json([
    //                 "errors" => $th->errors()
    //             ], Response::HTTP_BAD_REQUEST); 
    //         }

    //         return response()->json([
    //             "errors" => $th->getMessage()
    //         ], Response::HTTP_UNAUTHORIZED);
    //     }
    // }

    public function login()
    {
        try {
            request()->validate([
                "email" => "required|email",
                "password" => "required",
            ]);

            $user = User::where("email", request("email"))->first();
    
            if ($user && Hash::check(request("password"), $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
    
                $response = [
                    'token' => $token,
                    'user' => [
                        'id' => $user->id,
                        'email' => $user->email,
                        'type' => $user->type,
                    ],
    
                    'redirect' => $user->type == '1' ? 'admin/dashboard' : 'home',
                ];
    
                return response()->json($response);
            }
    
            return response()->json(['message' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server error'], 500);
        }
    }
}
