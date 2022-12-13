<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $category_film = DB::table('film')->join('film_category', 'film_category.film_id', '=', 'film.film_id')
                                          ->join('categories', 'film_category.category_id', '=', 'categories.category_id')
                                          ->select('categories.category_name')
                                          ->get();
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
        $des = 'public/uploads/avatar_film';
        $imgname = $request->file('img')->getClientOriginalName();
        $params = [
            'film_name' => $request->film_name,
            'description' => $request->description,
            'img' => $imgname,
            'episodes_quantity' => $request->episodes_quantity,
            'release_date' => $request->release_date
        ];
        DB::table('film')->insert($params);
        $request->file('img')->move($des, $imgname);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
