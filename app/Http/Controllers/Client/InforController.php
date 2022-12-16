<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Episode; 
use App\Models\Film;
use App\Models\Store;
use Illuminate\Http\Request;

class InforController extends Controller
{
    //

    public function index(Request $request, $id) {
        $list_episodes = Episode::getListEpisodes($id); 
        $film = Film::getFilm($id); 
        return view('clients.infor', compact('id','list_episodes', 'film')); 
    }
    public function unfollowFilm($film_id) {
        Store::deleteFilm(session('user_id'), $film_id);
        return redirect()->route('infor.view', $film_id);
    }
}
