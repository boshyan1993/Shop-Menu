<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
 
    public function showRegister()
    {
        return view('auth.register');
    }

  
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        Mail::to($user->email)->send(
        new WelcomeMail($user->name)
        );

        return redirect('/')->with(
            'success',
            'Գրանցումը հաջողությամբ կատարվեց։'
        );
    }



    public function showLogin()
    {
        return view('auth.login');
    }

  
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/')->with(
                'success',
                'Մուտքը հաջողությամբ կատարվեց։'
            );
        }

        return back()->withErrors([
            'email' => 'Email-ը կամ գաղտնաբառը սխալ է։',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with(
            'success',
            'Դուք դուրս եկաք համակարգից։'
        );
    }
}
