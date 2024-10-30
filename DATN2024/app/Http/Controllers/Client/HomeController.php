<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    { 
        return view('client.home');
    }

    public function register()
    { 
        return view('client.auth.register');
    }
    public function login()
    { 
        return view('client.auth.login');
    }
}