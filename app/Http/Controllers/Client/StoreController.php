<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $followedFilm = Store::getFollowedFilm(session('user_id'));
        return view('clients.store', ["followedFilm" => $followedFilm]);
    }
    public function insert(Request $request)
    {
        $item = array(
            "user_id" => session('user_id'),
            "film_id" => $request->film_id
        );
        Store::insertFilm($item);
        return redirect()->route('infor.view', $request->film_id);
    }
    public function delete($film_id)
    {
        Store::deleteFilm(session('user_id'), $film_id);
        return redirect()->route('store.index');
    }
}