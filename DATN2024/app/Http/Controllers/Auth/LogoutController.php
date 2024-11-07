<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LogoutController extends Controller
{
    public function logout()
    {
        try{
            request()->user()->currentAccessToken()->delete();

            return response()->json([
                "message" => "Logout success"
            ]);

        }catch(\Throwable $th){
            return response()->json([
                "errors" => $th->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
// sdfsdf