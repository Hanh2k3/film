<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
    use HasFactory;
    static public function getFollowedFilm($user_id)
    {
        $followedFilm = DB::table('film_store')
            ->join('film', 'film_store.film_id', '=', 'film.film_id')
            ->where('film_store.user_id', $user_id)
            ->select('*')
            ->get();
        return $followedFilm;
    }
    static public function checkFollowedFilm($user_id, $film_id)
    {
        $followedFilm = DB::table('film_store')
            ->where([
                ['user_id', $user_id],
                ['film_id', $film_id]
            ])
            ->get();
        if(sizeof($followedFilm) > 0)
            return true;
        else 
            return false;
    }
    static public function insertFilm($item)
    {
        DB::table('film_store')
            ->insert([
                'user_id' => $item['user_id'],
                'film_id' => $item['film_id'],
            ]);
    }
    static public function deleteFilm($user_id, $film_id)
    {
        $followedFilm = DB::table('film_store')
            ->where([
                ['user_id', $user_id],
                ['film_id', $film_id]
            ])
            ->delete();
    }
}
