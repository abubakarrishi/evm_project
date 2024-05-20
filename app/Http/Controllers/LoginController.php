<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail as FacadesMail;
use mail;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {
            $credentials = ['email' => $request->email, 'password' => $request->password];

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if (is_null($user->email_verified_at)) {
                    Auth::logout();
                    return redirect()->route('account.login')->with('error', 'Your email address is not verified. Please check your email for the verification link.');
                }

                return redirect()->route('account.dashboard');
            } else {
                return redirect()->route('account.login')->with('error', 'Either email or password is incorrect.');
            }
        } else {
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }
    }

    public function register()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ]);

        if ($validator->passes()) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(40),
                'role' => 'voter',
            ]);
            FacadesMail::to($user->email)->send(new RegisterMail($user));
            return redirect()->route('account.login')->with('success', 'You have successfully registered and verify your email address');
        } else {
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }
    }


    public function verify($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();
            return redirect()->route('account.login')->with('success', 'Your account has been successfully verified.');
        } else {

            return redirect()->route('account.login')->with('error', 'Invalid verification token.');
        }
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
