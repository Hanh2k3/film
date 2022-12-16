<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; 
use App\Models\Episode; 
use App\Models\Film;
use App\Models\User;  
use App\Models\Evaluate; 
class HomeController extends Controller

{
    public function index() {
        // get list film đề cử 
        $film = Film::getListFilm(3); 
        $list_film = null ; 
        $i = 0 ; 
        foreach ($film as $item) {
            $film_id = $item->film_id;  
            $list_film[$i] = sizeof(Episode::getListEpisodes($film_id)); 
            $i +=1; 
        }
        $i = 0 ;
       
        // get film new
        $film_new = Film::getListFilm(2);
        $list_film_new = null ; 
        $i = 0 ; 
        foreach ($film_new as $item) {
            $film_id = $item->film_id;  
            $list_film_new[$i] = sizeof(Episode::getListEpisodes($film_id)); 
            $list_score = Evaluate::get_avg_evaluation($film_id);
            $i +=1; 
        }

        return view('clients.home', compact('film', 'list_film', 'film_new', 'list_film_new', 'list_score')); 
    }


}
