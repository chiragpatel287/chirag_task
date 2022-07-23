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

class RegisterController extends BaseController
{

    public function registerUser()
    {
        return view('sign_up');
    }

     public function checkEmailExistOrNot(Request $request)
    {
        $query = User::where('email', $request->email)->where('status', 1)->whereNull('deleted_at')->first();

        if (!empty($query)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function frontRegister(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return redirect('sign-up')
                ->withErrors($validator, 'add')
                ->withInput();
        } else {
            $insertArray = array(
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            );

            $insert = User::create($insertArray);
            if ($insert->id) {
                $userId = $insert->id;

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
        }
    }
}
