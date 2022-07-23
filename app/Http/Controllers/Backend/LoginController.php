<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    public function login()
    {
        return view('login.login');
    }

    public function userLogin(Request $request)
    {
        $credentials = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if (auth()->attempt($credentials)) {
            return redirect()->route('blogs.index')->with('success', 'Successfully Logged In');
        } else {
            return redirect()->route('login')->with('error', 'Email or Password is incorrect');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', 'Logout Successfully');
    }
}
