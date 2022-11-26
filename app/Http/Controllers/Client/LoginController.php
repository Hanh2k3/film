<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Str ;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    //
    // view login 
    public function index(){
        return view('clients.login');
    }

    public function login() {
        dd('login'); 
    }

    // login with google  
    public function login_google() {
        return Socialite::driver('google')->redirect();
    }
    public function google_callback(Request $request) {

        $user = Socialite::driver('facebook')->user();
        $data['provider'] = 'google';
        $data['provider_user_id'] = $user->id;
        $data['status'] = 0; 
        
        $account = User::userSocial($data);
        
        if($account) {
            $request->session()->put('login_success','login_success'); 
            $request -> session() -> put('provider_user_id', $user->id);
            $request->session()->put('provider', 'google');
            return redirect() -> route('home.');

        } else {
            $data['name'] = $user->name;
            $data['provider'] = 'google';
            $data['provider_user_id'] = $user->id;
            $data['email_social'] = $user->email;

            User::create_user_social($data); 

            $request->session()->put('login_success','login_success'); 
            $request -> session() -> put('provider_user_id', $user->id);
            $request->session()->put('provider', 'google');

            return redirect() -> route('home.');

        }
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
        $user = User::get_user_by_email($email);
        $user_name = $user->user_name;
        $user_email = $user->user_email;
        $user_id = $user->user_id;

        $token['token'] = Str::random(10);
        $token1 = $token['token'];
        User::update_token($user_id, $token);
        Mail::send('clients.mail_change_password', ['user_id' => $user_id ,'token' => $token1] , function ($email) use($user_email, $user_name) {
            $email -> to($user_email, $user_name) -> subject("Thay đổi mật khẩu"); // error here
        });
        return back() -> with('send_mail_success', 'Vui lòng kiểm tra email của bạn'); 
    }

    // change password 
    public function change_password_view($id, $token) {
   
        $check = User::check_token($id, $token);
        $user_id = $id; 
    
        if($check != null) {
            return view('clients.change_password_view', compact('user_id'));
        } 
        return back(); 
    }

    public function change_password(Request $request) {
        $request ->  validate([
            'password' => ['required', 'min:6'], 
            'confirm_password' => ['required', 'same:password'],
        ],[
            'password.required' => 'Vui lòng nhập mật khẩu mới của bạn',
            'password.min' => 'Mật khẩu ít nhất 6 ký tự', 
            'confirm_password.required' => 'Vui lòng nhập trường này',
            'confirm_password.same' => 'Không giống với mật khẩu'
        ]);
        $user_id = $request-> user_id;
        $password = MD5($request-> password);
        User::change_password($user_id, $password); 
        $token['token'] = null; 
        User::update_token($user_id, $token);
        return redirect() -> route('login.index') -> with('change_password_success', 'Thay đổi mật khẩu thành công'); 

    }
}