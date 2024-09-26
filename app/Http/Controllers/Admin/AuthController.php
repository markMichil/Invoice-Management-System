<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function __construct(){
        $this->pageTitle = 'Login';
    }


    public function login()
    {

        if (Auth::check() &&  Auth::user()->isAdmin()) {
            return redirect()->route('adminDashboard');
        }
        return view('AdminPanel.login')->with('pageTitle',$this->pageTitle);
    }

    public function handleLogin(Request $request)
    {

        $request->validate(User::loginRules());
        $email = $request->email;
        $password = $request->password;
        $data = ['email' => $email, 'password' => $password];
        if (Auth::attempt($data)) {
            // Success redirect
            return redirect()->intended(route('adminDashboard'));
        } else {
            return redirect()->back()
                ->with('status', 'login_error')
                ->with('message', "Email Or Password Wrong");
        }
    }


    public function logout()
    {
        auth()->logout();

        return redirect()->route('adminLogin');
    }


}
