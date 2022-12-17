<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::get_user_by_id(session('user_id'));
        return view('clients.profile', compact('user'));
    }
    public function updateAvatar(Request $request)
    {
        // if(!$request->hasFile('new_avatar')) {
        //     return "Bạn chưa chọn file";
        // }
        $oldname = $request->old_avatar;
        $newavt = $request->file('new_avatar');
        $newname = md5(uniqid(rand(), true)) . '.' . $newavt->getClientOriginalExtension();
        $newavt->move('uploads/avatar', $newname);

        User::update_avatar(session('user_id'), $newname);
        $pathfile = public_path() . "\\uploads\\avatar\\" . $oldname;
        (file_exists($pathfile)) && unlink($pathfile);
        return redirect()->route('profile.index');
    }
    public function updateUser(Request $request)
    {
        User::update_user(session('user_id'), $request->user_name, $request->user_email);
        return redirect()->route('profile.index');
    }
}