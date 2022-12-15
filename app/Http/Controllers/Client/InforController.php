<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Episode; 
use App\Models\Film; 
use Illuminate\Http\Request;
use App\Models\Evaluate;
use App\Models\Film_cmt; 
use App\Models\Sub_film_cmt; 

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
        $list_cmt = Film_cmt::get_cmt($id);
        
        foreach ($list_cmt as $item) {
            $list_sub_cmt = Sub_film_cmt::get_sub_cmt($item->comment_id); 

            if(sizeof($list_sub_cmt) != 0 ) {
                $item -> sub_cmt = $list_sub_cmt;
            } else {
                $item -> sub_cmt = null;
                
            }
        }
        
         
        return view('clients.infor', compact('id','list_episodes', 'film', 'num_star', 'score', 'list_cmt')); 
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
    public function save_comment(Request $request) {
        $comment_content = $request-> comment; 
        $data['comment_content'] =   $comment_content;         
        $data['user_id'] = session('user_id'); 
        $data['film_id'] = $request-> film_id;

        $comment_id = Film_cmt::add_comment($data); 

        $list_cmt = Film_cmt::get_cmt($data['film_id']);
        
        foreach ($list_cmt as $item) {
            $list_sub_cmt = Sub_film_cmt::get_sub_cmt($item->comment_id); 

            if(sizeof($list_sub_cmt) != 0 ) {
                $item -> sub_cmt = $list_sub_cmt;
            } else {
                $item -> sub_cmt = null;
                
            }
        }
        $result = ''; 

        foreach ($list_cmt as $comment) {
           if($comment->provider) {
                $img = '<img src="'. $comment->avt . '" alt="">'; 

           } else {
                $img = '<img src="'.asset("uploads/avatar/$comment->avt") . '" alt="">'; 

           }
           $result.= ' <li>
           <div class="parent_comment">
           <div class="c_comment_head">

               <a href="#">'.
                  $img.'
               </a>
           </div>
           <div>
               <div class="c_comment_body">
                   <a class="c_comment_user" href="#">'. $comment->user_name .'</a>
                   <p class="c_comment_content">'. $comment-> comment_content .'</p>
                   <div>
                       <p><a href="">Trả lời</a></p>
                       <p class="c_comment_time">'. $comment-> created_at .'</p>
                   </div>
               
               </div>
          
            </div>
            </div>'; 

           if($comment->sub_cmt) {
                foreach ($comment->sub_cmt as $sub) {
                    if($sub->provider) {
                        $img_sub = '<img src="'. $sub->avt . '" alt="">'; 
        
                   } else {
                        $img_sub = '<img src="'.asset("uploads/avatar/$sub->avt") . '" alt="">'; 
        
                   }
                   $result.= '<div class="div_b">
                    <div class="sub_cmt">
                        <div class="c_comment_head">
                            <a href="#">'.
                                $img_sub
                            .'</a>
                        </div>
                        <div>
                            <div class="c_comment_body">
                                <a class="c_comment_user" href="#">'. $sub-> user_name .'</a>
                                <p class="c_comment_content">'. $sub-> comment_content .'</p>
                                <div>
                                    <p class="c_comment_time">'. $sub->created_at .'</p>
                                </div>
                            </div>
                        </div>
                    </div>
               </div> ';

                }

           }
           $result .= '<form action="#" method="GET">
            
                <textarea name="comment" id="comment" class="cmt_1" cols="10" rows="5"></textarea>
                <div class="div_comment">
                    <i class="first-btn ti-comments-smiley"></i>
                    <input type="submit" value="Bình luận" id="btn_cmt">
                </div>
            </form>
            </li> ';
           

        }


        
        return  $result; 
    }
    
}
