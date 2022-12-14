<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Film extends Model
{
    use HasFactory;
    public $table = 'film';
    static function getListFilm($category_id) { // get film by category 
        $listFilm = DB::table('film')
                    -> join('film_category', 'film.film_id', '=', 'film_category.film_id')
                    -> where('film_category.category_id', $category_id)
                    -> select('film.*')
                    -> get();
        return $listFilm ; 
    }

    static function getFilm($id) {
        $film = DB::table('film') -> where('film_id', $id) -> first();
        return $film;
    }
    
}
