<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Episode; 
use App\Models\Film; 
use Illuminate\Http\Request;
use App\Models\Evaluate;

class InforController extends Controller
{
    //

    public function index(Request $request, $id) {
        $list_episodes = Episode::getListEpisodes($id); 
        $film = Film::getFilm($id); 
        
        $check = Evaluate::check_evaluation(session('user_id'), $id); 

        // star of user evaluate 
        if($check) {
            $num_star = Evaluate::get_evaluate(session('user_id'), $id) -> evaluate_value; 
        } else {
            $num_star = 0 ; 
        }
        $score = $request->score;
        return view('clients.infor', compact('id','list_episodes', 'film', 'num_star', 'score')); 
    }

    // evaluate film 
    public function evaluate_film(Request $request) {
      
        $data['user_id'] = $request-> user_id;
        $data['film_id'] = $request-> film_id;
        $data['evaluate_value'] = $request-> evaluate_value;
        
        $check = Evaluate::check_evaluation($data['user_id'], $data['film_id']); 
        if($check) {
          
    
            Evaluate::update_evaluation($data['user_id'], $data['film_id'], $data['evaluate_value']); 
           
        } 
        else {
            
            Evaluate::add_evaluation($data);
        
        }
        return $data['evaluate_value']; 
    }

    // comment 
    
}
