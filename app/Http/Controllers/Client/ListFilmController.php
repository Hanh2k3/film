<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Category;
use App\Models\Episode;
use App\Models\Evaluate;

class ListFilmController extends Controller
{
    //

    public function list_film_category($id)
    {
        $category_id = $id;
        $category = Category::get_category($id);
        $film_new = Film::getListFilm($category_id);
        $list_film_new = null;
        $i = 0;
        $list_score = null;
        foreach ($film_new as $item) {
            $film_id = $item->film_id;
            $list_film_new[$i] = sizeof(Episode::getListEpisodes($film_id));

            $list_score[$i] = Evaluate::get_avg_evaluation($film_id);
            $i += 1;
        }

        return view('clients.category_film', compact('list_film_new', 'list_score', 'film_new', 'category'));
    }
}