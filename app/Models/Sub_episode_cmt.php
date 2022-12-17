<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sub_episode_cmt extends Model
{
    use HasFactory;

    static function get_sub_cmt($comment_id)
    {
        $list_cmt = DB::table('sub_episode_cmt')
            ->leftJoin('users', 'sub_episode_cmt.user_id', '=', 'users.user_id')
            ->select('sub_episode_cmt.*', 'users.user_name', 'users.avt', 'users.provider')
            ->orderBy('sub_episode_cmt.created_at', 'DESC')
            ->where('comment_id', $comment_id)
            ->get();
        return $list_cmt;
    }

    static function add_sub_comment($data)
    {
        DB::table('sub_episode_cmt')->insert($data);
    }
}