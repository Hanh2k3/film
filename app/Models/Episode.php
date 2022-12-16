<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Episode extends Model
{
    use HasFactory;
    public $primaryKey = 'episode_id';
    static function getListEpisodes($film_id) {
        $episode = DB::table('episodes') -> where('film_id', $film_id) -> orderBy('episode_number', 'ASC')->get();
        return $episode;  
    }

    static function getEpisode($film_id, $episode) {
        $episode = DB::table('episodes') -> where('film_id', $film_id) -> where('episode_number', $episode) -> first(); 
        return $episode;
    }

    

    

}
