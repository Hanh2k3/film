<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Category;
use App\Models\Episode;
use App\Models\Evaluate;
class SearchController extends Controller
{
    //

    public function index(Request $request)
    {
        $key = $request->key;
       
        $film = Film::search_film($key); 
        
        if(sizeof($film) == 0) {
            $define = true ; 
            return view('clients.search_film', compact('define')); 
        }

        $film_new = $film;
        $list_film_new = null;
        $i = 0;
        foreach ($film_new as $item) {
            $film_id = $item->film_id;
            $list_film_new[$i] = sizeof(Episode::getListEpisodes($film_id));

            $list_score[$i] = Evaluate::get_avg_evaluation($film_id);
            $i += 1;
        }

        return view('clients.search_film', compact('film_new', 'list_film_new', 'list_score', 'key'));
        
        
    }

    public function filter_by_year(Request $request) {
        $year = $request->year;
        $film = Film::get_by_year($year);
        $film_new = $film;
        $list_film_new = null;
        $i = 0;
        foreach ($film_new as $item) {
            $film_id = $item->film_id;
            $list_film_new[$i] = sizeof(Episode::getListEpisodes($film_id));

            $list_score[$i] = Evaluate::get_avg_evaluation($film_id);
            $i += 1;
        }
        return view('clients.year_film', compact('film_new', 'list_film_new', 'list_score', 'year'));
        
    }
}