<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Episode; 
use App\Models\Film;
use App\Models\Store;
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
        $list_cmt = Film_cmt::get_cmt($id,5);
        
        foreach ($list_cmt as $item) {
            $list_sub_cmt = Sub_film_cmt::get_sub_cmt($item->comment_id); 

            if(sizeof($list_sub_cmt) != 0 ) {
                $item -> sub_cmt = $list_sub_cmt;
            } else {
                $item -> sub_cmt = null;
                
            }
        }
        $total = sizeof(Film_cmt::get_all($id)); 

      
        
    
        return view('clients.infor', compact('id','list_episodes', 'film', 'num_star', 'score', 'list_cmt', 'total')); 
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
        

        if($request -> answer) {
            // answer comment 
            $data['comment_id'] = $request -> comment_id;
            Sub_film_cmt::add_sub_comment($data); 
        } else {
            $data['film_id'] = $request-> film_id;
            $comment_id = Film_cmt::add_comment($data); 
        }
        $data['film_id'] = $request-> film_id;
       
       

        $list_cmt = Film_cmt::get_cmt($data['film_id'],$request->times_load);
        
        foreach ($list_cmt as $item) {
            $list_sub_cmt = Sub_film_cmt::get_sub_cmt($item->comment_id); 

            if(sizeof($list_sub_cmt) != 0 ) {
                $item -> sub_cmt = $list_sub_cmt;
            } else {
                $item -> sub_cmt = null;
                
            }
        }
        $result = ''; 
        $select = ''; 

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
                       <p><button href="" class="answer" data-id="'. $comment-> comment_id.'" onclick="test1();">Trả lời</button></p>
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
           $result .= '<form action="#" method="GET" class="un_active" id="form_answer_'. $comment -> comment_id .'">
            
                <textarea name="comment_'. $comment -> comment_id .'" id="comment_'. $comment -> comment_id .'" class="comment_a" cols="10" rows="5"></textarea>
                <div class="div_comment">
                    <i class="first-btn ti-comments-smiley" id="btn_'. $comment -> comment_id.'"></i>
                    <input type="submit" value="Bình luận" class="btn_submit" id="btn_submit_'. $comment -> comment_id .' data-id="'. $comment->comment_id .'">
                </div>
            </form>
            </li> ';

            $select .= '{
                selector: "#btn_'. $comment -> comment_id.'",
                insertInto: "#comment_'. $comment -> comment_id.'"
            },';
        }

        $result .= '
            <script>
                new EmojiPicker({
                    trigger: [
                        {
                            selector: "#binh_luan",
                            insertInto: "#comment" 
                        },
                        '. $select .' 
                    
                        
                    ], 
                    closeButton: true,
                
                });   
            </script>';
        return  $result; 
    }

    public function load_comment(Request $request) {
        $data['film_id'] = $request-> film_id;
        $data['times_load'] = $request-> times_load;
        $list_cmt = Film_cmt::get_cmt($data['film_id'],$data['times_load']);
        foreach ($list_cmt as $item) {
            $list_sub_cmt = Sub_film_cmt::get_sub_cmt($item->comment_id); 

            if(sizeof($list_sub_cmt) != 0 ) {
                $item -> sub_cmt = $list_sub_cmt;
            } else {
                $item -> sub_cmt = null;
                
            }
        }

        $result = ''; 
        $select = ''; 

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
                       <p><button href="" class="answer" data-id="'. $comment-> comment_id.'" onclick="test1();">Trả lời</button></p>
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
           $result .= '<form action="#" method="GET" class="un_active" id="form_answer_'. $comment -> comment_id .'">
            
                <textarea name="comment_'. $comment -> comment_id .'" id="comment_'. $comment -> comment_id .'" class="comment_a" cols="10" rows="5"></textarea>
                <div class="div_comment">
                    <i class="first-btn ti-comments-smiley" id="btn_'. $comment -> comment_id.'"></i>
                    <input type="submit" value="Bình luận" class="btn_submit" id="btn_submit_'. $comment -> comment_id .' data-id="'. $comment->comment_id .'">
                </div>
            </form>
            </li> ';

            $select .= '{
                selector: "#btn_'. $comment -> comment_id.'",
                insertInto: "#comment_'. $comment -> comment_id.'"
            },';
        }

        $result .= '
            <script>
                new EmojiPicker({
                    trigger: [
                        {
                            selector: "#binh_luan",
                            insertInto: "#comment" 
                        },
                        '. $select .' 
                    
                        
                    ], 
                    closeButton: true,
                
                });   
            </script>';
      
        $rs['result'] = $result; 
        $rs['total_cmt'] = sizeof(Film_cmt::get_all($data['film_id'])); 
        return  $rs; 

    }
    

    public function unfollowFilm($film_id) {
        Store::deleteFilm(session('user_id'), $film_id);
        return redirect()->route('infor.view', $film_id);
    }

}
