<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    //

    public function test_send_mail(Request $request) {
        Mail::send('clients.mail_change_password',['id' => 1], function ($email) {
            $email -> to('lehanh29102019@gmail.com', "Hanh dep trai") -> subject("Thay đổi mật khẩu"); // error here
        });
    
    }
}
