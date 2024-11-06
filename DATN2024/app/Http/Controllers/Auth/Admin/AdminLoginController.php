<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        $user = User::where('email', $request->email)->first();

        if (!$user || !$user->isAdmin()) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Invalid admin credentials or you are not authorized to access admin area.']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');

        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Invalid admin credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}
