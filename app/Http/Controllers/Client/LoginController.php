<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    //
    // view login 
    public function index()
    {
        return view('clients.login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],

            ]
            ,
            [
                'email.required' => 'Vui lòng nhập địa chỉ email',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'email.email' => 'Email không đúng định dạng'
            ]
        );

        $email = trim($request->email);
        $password = trim(MD5($request->password));


        $user = User::check_user($email, $password);

        if ($user) {
            session()->put('user_id', $user->user_id);
            session()->put('user_name', $user->user_name);
            session()->put('user_avatar', $user->avt);
            session()->put('type_user', $user->type_user);

            return redirect()->route('home.');
        } else {
            return back()->with('erorr_login', 'Email hoặc mật khẩu không đúng');
        }
    }

    // login with google  
    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }
    public function google_callback(Request $request)
    {

        $user = Socialite::driver('google')->stateless()->user();



        $email = User::check_google($user->email);



        if ($email) {
            if ($email->provider) {
                // google
                session()->put('user_id', $email->user_id);
                session()->put('user_name', $email->user_name);
                session()->put('user_avatar', $email->avt);
                session()->put('type_user', $user->type_user);
                session()->put('google', 'google');
                return redirect()->route('home.');
            } else {
                // normal 
                return redirect()->route('login.index')->with('erorr_login', 'Email đã được sử dụng để tạo tài khoản');
            }
        } else {
            // add new 
            $data['user_name'] = $user->name;
            $data['user_email'] = $user->email;
            $data['avt'] = $user->avatar;
            $data['provider'] = 'google';

            $id = User::insert_user_google($data);
            session()->put('user_id', $id);
            session()->put('user_name', $user->user_name);
            session()->put('user_avatar', $user->avatar);

            session()->put('google', 'google');
            return redirect()->route('home.');

        }

    }

    // forget password 
    public function view_forget_password()
    {
        return view('clients.forget_password');
    }

    public function send_mail_password(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,user_email']
        ], [
                'email.required' => 'Vui lòng nhập địa chỉ email',
                'email.email' => 'Vui lòng nhập đúng định dạng email',
                'email.exists' => 'Email chưa được tạo tài khoản',
            ]);


        $email = $request->email;
        $user = User::get_user_by_email($email);
        $user_name = $user->user_name;
        $user_email = $user->user_email;
        $user_id = $user->user_id;

        $token['token'] = Str::random(10);
        $token1 = $token['token'];
        User::update_token($user_id, $token);
        Mail::send('clients.mail_change_password', ['user_id' => $user_id, 'token' => $token1], function ($email) use ($user_email, $user_name) {
            $email->to($user_email, $user_name)->subject("Thay đổi mật khẩu"); // error here
        });
        return back()->with('send_mail_success', 'Vui lòng kiểm tra email của bạn');
    }

    // change password 
    public function change_password_view($id, $token)
    {

        $check = User::check_token($id, $token);
        $user_id = $id;

        if ($check != null) {
            return view('clients.change_password_view', compact('user_id'));
        }
        return back();
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
        ], [
                'password.required' => 'Vui lòng nhập mật khẩu mới của bạn',
                'password.min' => 'Mật khẩu ít nhất 6 ký tự',
                'confirm_password.required' => 'Vui lòng nhập trường này',
                'confirm_password.same' => 'Không giống với mật khẩu'
            ]);
        $user_id = $request->user_id;
        $password = MD5($request->password);
        User::change_password($user_id, $password);
        $token['token'] = null;
        User::update_token($user_id, $token);
        return redirect()->route('login.index')->with('change_password_success', 'Thay đổi mật khẩu thành công');

    }


    // logout 
    public function logout()
    {
        session()->flush();
        return redirect()->route('home.');
    }
}