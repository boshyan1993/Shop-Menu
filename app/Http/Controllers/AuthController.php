<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Գրանցման էջ
    public function showRegister()
    {
        return view('auth.register');
    }

    // Գրանցում
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Ստուգում ենք User դերի առկայությունը
        Role::where('slug', 'user')->firstOrFail();

        // Ստեղծում ենք օգտատիրոջը
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Ավտոմատ նշանակում ենք User դեր
        $user->assignRole('user');

        // Մուտք ենք գործում համակարգ
        Auth::login($user);

        // Ուղարկում ենք email-ի հաստատման նամակ
        $user->sendEmailVerificationNotification();

        // Ուղարկում ենք ողջույնի նամակ
        try {
            Mail::to($user->email)->send(
                new WelcomeMail($user->name)
            );
        } catch (\Exception $e) {
            Log::error(
                'Welcome email failed: ' . $e->getMessage()
            );
        }

        return redirect('/')->with(
            'success',
            'Գրանցումը հաջողությամբ կատարվեց։ Ձեր դերը՝ '
            . $user->role_name
        );
    }

    // Մուտքի էջ
    public function showLogin()
    {
        return view('auth.login');
    }

    // Մուտք
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

    // Ելք
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