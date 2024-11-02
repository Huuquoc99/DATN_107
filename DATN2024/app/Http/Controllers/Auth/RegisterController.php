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
