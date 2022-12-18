<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $film_data = Film::count_film();
        $user_data = User::get_user();
        $user_today = User::user_today();
        $user_month = User::user_month();
        $user_year = User::user_year();
        // return "<pre>". $film_data ."</pre>";
        return view('admin.index', compact('film_data', 'user_data', 'user_today', 'user_month', 'user_year'));
    }

    public function deleteUser(Request $request) {
        DB::table('users')
            ->where('user_id', '=', $request->user_id)
            ->delete();
        return redirect()->route('adminindex');
    }
}
