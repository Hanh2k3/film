<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Film_cmt extends Model
{
    use HasFactory;

    static function add_comment($data) {
        $comment_id = DB::table('film_cmt') -> insertGetId($data);
        return $comment_id;

    }

    static function get_cmt($film_id, $count) {
        $list_cmt = DB::table('film_cmt')
                    ->  leftJoin('users', 'film_cmt.user_id', '=', 'users.user_id')
                    -> select('film_cmt.*', 'users.user_name', 'users.avt', 'users.provider')
                    -> where('film_id', $film_id)
                    -> orderBy('film_cmt.created_at', 'DESC')
                    -> limit($count)
                    -> get(); 
        return $list_cmt;
    }

    static function get_all($film_id) {
        $list_cmt = DB::table('film_cmt')
                    ->  leftJoin('users', 'film_cmt.user_id', '=', 'users.user_id')
                    -> select('film_cmt.*', 'users.user_name', 'users.avt', 'users.provider')
                    -> where('film_id', $film_id)
                    -> orderBy('film_cmt.created_at', 'DESC')
                    -> get(); 
        return $list_cmt;
    }
    
}
