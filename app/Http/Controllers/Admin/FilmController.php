<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Film;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = DB::table('film')->get();
        return view('admin.films.listfilm', ['films' => $films]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_film = Category::listCategory();
        return view('admin.films.addfilm', ['category_film' => $category_film]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $film = new Film();
        $category_id = $data['category_film'];
        $film->film_name = $data['film_name'];
        $film->description = $data['description'];
        //add img
        $get_img = $request->file('img');
        $path = 'uploads/avatar_film/';
        if ($get_img) {
            $get_name_img = $get_img->getClientOriginalName();
            $get_img->move($path, $get_name_img);
            $film->img = $get_name_img;
        }

        $film->episodes_quantity = $data['episodes_quantity'];
        $film->release_date = $data['release_date'];
        $film->save();

        $id = Film::where('film_name', $film->film_name)->value('film_id');
        DB::table('film_category')->insert([
            'film_id' => $id,
            'category_id' => $category_id
        ]);
        return redirect()->route('adminfilm.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_film = Category::listCategory();
        $getfilm = DB::table('film')
                    -> join('film_category', 'film.film_id', '=', 'film_category.film_id')
                    -> join('categories', 'categories.category_id', '=', 'film_category.category_id')
                    -> where('film_category.film_id', $id)
                    -> select('*')
                    -> first();
        return view('admin.films.editfilm', ['getfilm' => $getfilm, 'category_film' => $category_film]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $film = Film::find($id);
        $category_id = $data['category_film'];
        $film->film_name = $data['film_name'];
        $film->description = $data['description'];
        //add img
        $get_img = $request->file('img');
        $path = 'uploads/avatar_film/';
        if ($get_img) {
            if (!empty($film->img)) {
                unlink('uploads/avatar_film/'.$film->img);
            }
            $get_name_img = $get_img->getClientOriginalName();
            $get_img->move($path, $get_name_img);
            $film->img = $get_name_img;
        }

        $film->episodes_quantity = $data['episodes_quantity'];
        $film->release_date = $data['release_date'];
        $film->save();

        $id_get = Film::where('film_name', $film->film_name)->value('film_id');
        DB::table('film_category')->where('film_id', $id_get)->update(['category_id' => $category_id]);
        return redirect()->route('adminfilm.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $film = Film::find($id);
        if (!empty($film->img)) {
            unlink('uploads/avatar_film/'.$film->img);
        }
        $film->delete();
        return redirect()->route('adminfilm.index');
    }
}
