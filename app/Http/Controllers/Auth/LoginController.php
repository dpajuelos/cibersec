<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if (!$request->session()->has('url.intended')) {
            $request->session()->put('url.intended', url()->previous());
        }
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->isActive() && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); 
    }
}