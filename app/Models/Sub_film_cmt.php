<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sub_film_cmt extends Model
{
    use HasFactory;

    static function get_sub_cmt($comment_id) {
        $list_cmt = DB::table('sub_film_cmt')
                    ->  leftJoin('users', 'sub_film_cmt.user_id', '=', 'users.user_id')
                    -> select('sub_film_cmt.*', 'users.user_name', 'users.avt', 'users.provider')
                    -> orderBy('sub_film_cmt.created_at', 'DESC')
                    -> where('comment_id', $comment_id)
                    -> limit(10)
                    -> get(); 
        return $list_cmt;
    }

    static function add_sub_comment($data) {
        DB::table('sub_film_cmt') -> insert($data);
    }

}
