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
        try{
            $data = request()->validate([
                "name" => "required",
                "email" => "required|email",
                "password" => "required|min:8|max:20|confirmed",
            ], [
                "name.required" => "The name field is required.",
                "email.required" => "The email field is required.",
                "email.email" => "Please provide a valid email address.",
                "password.required" => "The password field is required.",
                "password.min" => "The password must be at least 8 characters.",
                "password.max" => "The password may not be greater than 20 characters.",
                "password.confirmed" => "The password confirmation does not match.",
            ]);
            

            $user = User::create($data);
            $token = $user->createToken($user->id)->plainTextToken;

            return view('client.auth.login');
        }catch(\Throwable $th){
            if($th instanceof ValidationException){
                return response()->json([
                    "errors" => $th->errors()
                ], Response::HTTP_BAD_REQUEST);
            }

            return response()->json([
                "errors" => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
// sdfs