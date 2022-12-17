<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Episode_cmt extends Model
{
    use HasFactory;

    static function add_comment($data)
    {
        $comment_id = DB::table('episode_cmt')->insertGetId($data);
        return $comment_id;

    }

    static function get_cmt($episode, $film_id, $count)
    {
        $list_cmt = DB::table('episode_cmt')
            ->leftJoin('users', 'episode_cmt.user_id', '=', 'users.user_id')
            ->select('episode_cmt.*', 'users.user_name', 'users.avt', 'users.provider')
            ->where('episode', $episode)
            ->where('film_id', $film_id)
            ->orderBy('episode_cmt.created_at', 'DESC')
            ->limit($count)
            ->get();
        return $list_cmt;
    }

    static function get_all($episode, $film_id)
    {
        $list_cmt = DB::table('episode_cmt')
            ->leftJoin('users', 'episode_cmt.user_id', '=', 'users.user_id')
            ->select('episode_cmt.*', 'users.user_name', 'users.avt', 'users.provider')
            ->where('episode', $episode)
            ->where('film_id', $film_id)
            ->orderBy('episode_cmt.created_at', 'DESC')
            ->get();
        return $list_cmt;
    }
}