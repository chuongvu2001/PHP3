<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function postLogin(Request $request){
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])
            // || Auth::attempt(['phone_number' => $request->email, 'password' => $request->password])    
        ){
            return redirect(route('homepage'));
        }

        return view('auth.login', [
            'email' => $request->email,
            'msg' => "Tài khoản/mật khẩu không đúng!"
        ]);
    }
}
