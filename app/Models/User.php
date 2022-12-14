<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // insert_user 
    static function insert_user($data)
    {
        DB::table('users')->insert($data);
    }

    static function insert_user_google($data)
    {
        $id = DB::table('users')->insertGetId($data);
        return $id;
    }
    // get user by email 
    static function get_user_by_email($email)
    {
        $email = DB::table('users')->select('user_email', 'user_name', 'user_id')->where('user_email', $email)->first();
        return $email;

    }
    // get user by id 
    static function get_user_by_id($user_id)
    {
        $user = DB::table('users')->select('user_email', 'user_name', 'avt', 'provider', 'created_at')->where('user_id', $user_id)->first();
        return $user;
    }

    static function check_user($email, $password)
    {
        $user = DB::table('users')->where('user_email', $email)->where('password', $password)->first();
        return $user;
    }

    // update token 
    static function update_token($id, $token)
    {
        DB::table('users')->where('user_id', $id)->update($token);
    }

    static function check_token($id, $token)
    {
        $token = DB::table('users')->select('token')->where('user_id', $id)->where('token', $token)->first();
        return $token;
    }

    // change password 
    static function change_password($user_id, $password)
    {
        DB::table('users')->where('user_id', $user_id)->update(['password' => $password]);
    }

    static function check_google($user_email)
    {
        $user = DB::table('users')->where('user_email', $user_email)->first();
        return $user;
    }

    //update avatar
    static function update_avatar($user_id, $new_name)
    {
        DB::table('users')->where('user_id', $user_id)->update(['avt' => $new_name]);
    }
    //update user
    static function update_user($user_id, $user_name, $user_email)
    {
        DB::table('users')->where('user_id', $user_id)->update(['user_name' => $user_name, 'user_email' => $user_email]);
    }
    //Update last_login
    static function updateLastLogin($user_id) {
        DB::table('users')->where('user_id', '=', $user_id)->update(['last_login' => date('Y-m-d H-i-s')]);
    }

    //Admin
    static function get_user() {
        return DB::table('users')
            ->select('*')
            ->where('type_user', '<>', 'admin')
            ->get();
    }
    static function user_today() {
        return DB::table('users')
            ->select('*')
            ->where('type_user', '<>', 'admin')
            ->whereRaw('day(last_login) = day(curdate()) and month(last_login) = month(curdate()) and year(last_login) = year(curdate())')
            ->count();
    }
    static function user_month() {
        return DB::table('users')
            ->select('*')
            ->where('type_user', '<>', 'admin')
            ->whereRaw('month(last_login) = month(curdate()) and year(last_login) = year(curdate())')
            ->count();
    }
    static function user_year() {
        return DB::table('users')
            ->select('*')
            ->where('type_user', '<>', 'admin')
            ->whereRaw('year(last_login) = year(curdate())')
            ->count();
    }
}