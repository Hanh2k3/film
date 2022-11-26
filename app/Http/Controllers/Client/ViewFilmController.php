<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Episode; 
use App\Models\Film; 

class ViewFilmController extends Controller
{
    public function index(Request $request, $film_id, $episode)
    {
        $film = Film::getFilm($film_id);
        $list_episodes = Episode::getListEpisodes($film_id); 
        $item = Episode::getEpisode($film_id, $episode);
        $episodes_qty = sizeof( $list_episodes);
        
        if($episode > $episodes_qty) {
            return back(); 
        }

        return view('clients.viewfilm', compact('film', 'list_episodes', 'episode', 'item'));
    }
}
