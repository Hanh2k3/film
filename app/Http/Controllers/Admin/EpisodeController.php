<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Episode;
use App\Models\Film;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function createEpisode($id)
    {
        $getfull = Film::find($id);
        return view('admin.episode.addepisode', ['getfull' => $getfull]);
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
        $episode = new Episode();
        $episode->film_id = $data['film_id'];
        $episode->episode_link = $data['episode_link'];
        $episode->episode_number = $data['episode_number'];
        $episode->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $episodes = Episode::where('film_id', $id)->get();
        $fim = Film::where('film_id', $id)->get();
        return view('admin.episode.listepisode', ['episodes' => $episodes, 'fim' => $fim]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $episode_get = Episode::find($id);
        return view('admin.episode.editepisode', ['episode_get' => $episode_get]);
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
        $episode = Episode::find($id);
        $episode->film_id = $data['film_id'];
        $episode->episode_link = $data['episode_link'];
        $episode->episode_number = $data['episode_number'];
        $episode->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $film_delete = Episode::find($id);
        $film_delete->delete();
        return redirect()->back();
    }
}
