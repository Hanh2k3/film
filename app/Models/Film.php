<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Film extends Model
{
    use HasFactory;
    public $table = 'film';
    public $primaryKey = 'film_id';
    static function getListFilm($category_id)
    { // get film by category 
        $listFilm = DB::table('film')
            ->join('film_category', 'film.film_id', '=', 'film_category.film_id')
            ->where('film_category.category_id', $category_id)
            ->select('film.*')
            ->get();
        return $listFilm;
    }

    static function getFilm($id)
    {
        $film = DB::table('film')->where('film_id', $id)->get();
        return $film;
    }

    static function getFilmbyName($film_name)
    {
        $film = DB::table('film')->where('film_name', $film_name)->first();
        return $film;
    }

    public function scopeSearch($query)
    {
        if ($key = request()->searchByName) {
            $query = $query->where('film_name', 'like', '%' . $key . '%');
        }
        return $query;
    }

    static function search_film($key)
    {
        $listFilm = DB::table('film')
            ->where('film_name', 'like', '%' . $key . '%')
            ->orWhere('description', 'like', '%' . $key . '%')
            ->orWhere('episodes_quantity', 'like', '%' . $key . '%')
            ->get();
        return $listFilm;
    }

    static function get_listYear()
    {
        $list = DB::table('film')->select('release_date')->orderBy('release_date', 'DESC')->get();
        return $list;
    }

    static function get_by_year($year)
    {
        $list = DB::table('film')->where('release_date', 'like', $year . "%")->orderBy('release_date', 'DESC')->get();
        return $list; 
    }
}