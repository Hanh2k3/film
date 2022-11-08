<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    // view login 
    public function index(){
        return view('clients.login');
    }








    // forget password 
    public function view_forget_password() {
        return view('clients.forget_password'); 
    }

    public function send_mail_password(Request $request) {
        $request -> validate([
            'email' => ['required', 'email', 'exists:users,user_email']
        ],[
            'email.required' => 'Vui lòng nhập địa chỉ email', 
            'email.email' => 'Vui lòng nhập đúng định dạng email', 
            'email.exists' => 'Email chưa được tạo tài khoản',
        ]);


        $email = $request-> email;

        // send mail 

    }
}
