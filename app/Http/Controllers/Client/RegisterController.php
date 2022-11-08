<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Str; 

class RegisterController extends Controller
{
    //
   
    public function index() {
        $code_id = Str::random(8);
        session() -> put('code_id', $code_id);
        return view('clients.register', compact('code_id'));
    }

    public function insert_user(Request $request) {
      
        $code_id = $request->code_id;
        $confirm_code = $request-> confirm_code; 
        $request->  validate([
            'user_name' => ['required'],
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
            'email' => ['required', 'email', 'unique:users,user_email'],
            'code_id' => ['required', function ($attribute, $value, $fail) use($code_id, $confirm_code) {
                if ($code_id != $confirm_code) {
                    $fail('Mã xác thực không chính xác');
                }
            }], 
            'avt' => ['mimes:jpeg,jpg,png,gif','max:10000'],
        ],[
            'user_name.required' => 'Vui lòng nhập tên người dùng', 
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự',
            'confirm_password.required' => 'Vui lòng nhập đầy đủ trường này',
            'confirm_password.same' => 'Không đúng với mật khẩu',
            'email.required' => 'Vui lòng nhập địa chỉ email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được tạo tài khoản',
            'code_id.required' => 'Vui lòng nhập mã xác thực', 
            'avt.mimes' => 'Vui lòng chọn hình ảnh', 
        ]);

        $data['user_name'] = $request -> user_name; 
        $data['user_email'] = $request -> email ; 
        $data['avt'] = $request -> file('avt'); 
        $data['password'] = $request -> password; 

        dd($data); 


         
    }
}
