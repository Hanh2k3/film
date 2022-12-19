<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Film;
use App\Models\Episode_cmt;
use App\Models\Sub_episode_cmt;

class ViewFilmController extends Controller
{
    public function index(Request $request, $film_id, $episode)
    {
        $film = Film::getFilm($film_id);
        $list_episodes = Episode::getListEpisodes($film_id);

        $episodes_qty = sizeof($list_episodes);

        if ($episode > $episodes_qty) {
            return back();
        } else {
            $item = Episode::getEpisode($film_id, $episode);
            $link = $item->episode_link;
        }

        // get data comment
        $list_cmt = Episode_cmt::get_cmt($episode, $film_id, 5);

        foreach ($list_cmt as $item) {
            $list_sub_cmt = Sub_episode_cmt::get_sub_cmt($item->comment_id);

            if (sizeof($list_sub_cmt) != 0) {
                $item->sub_cmt = $list_sub_cmt;
            } else {
                $item->sub_cmt = null;

            }
        }
        $total = sizeof(Episode_cmt::get_all($episode, $film_id));

        

        // update view 
        $number_view = Episode::getView($film_id, $episode); 
        Episode::add_view($film_id, $episode, ['view' => $number_view->view + 1]); 
        

        return view('clients.viewfilm', compact('film', 'list_episodes', 'episode', 'link', 'list_cmt', 'total', 'film_id'));
    }



    public function save_comment(Request $request)
    {

        $comment_content = $request->comment;
        $data['comment_content'] = $comment_content;
        $data['user_id'] = session('user_id');


        if ($request->answer) {
            // answer comment 
            $data['comment_id'] = $request->comment_id;
            Sub_episode_cmt::add_sub_comment($data);
        } else {
            $data['film_id'] = $request->film_id;
            $data['episode'] = $request->episode;
            $comment_id = Episode_cmt::add_comment($data);
        }
        $data['film_id'] = $request->film_id;
        $data['episode'] = $request->episode;




        $list_cmt = Episode_cmt::get_cmt($data['episode'], $data['film_id'], $request->times_load);

        foreach ($list_cmt as $item) {
            $list_sub_cmt = Sub_episode_cmt::get_sub_cmt($item->comment_id);

            if (sizeof($list_sub_cmt) != 0) {
                $item->sub_cmt = $list_sub_cmt;
            } else {
                $item->sub_cmt = null;

            }
        }
        $result = '';
        $select = '';

        foreach ($list_cmt as $comment) {
            if ($comment->provider) {
                $img = '<img src="' . $comment->avt . '" alt="">';

            } else {
                $img = '<img src="' . asset("uploads/avatar/$comment->avt") . '" alt="">';

            }
            $result .= ' <li>
           <div class="parent_comment">
           <div class="c_comment_head">

               <a href="#">' .
                $img . '
               </a>
           </div>
           <div>
               <div class="c_comment_body">
                   <a class="c_comment_user" href="#">' . $comment->user_name . '</a>
                   <p class="c_comment_content">' . $comment->comment_content . '</p>
                   <div>
                       <p><button href="" class="answer" data-id="' . $comment->comment_id . '" onclick="test1();">Trả lời</button></p>
                       <p class="c_comment_time">' .date_format(date_create($comment->created_at), ' H:i d/m/Y ')  . '</p>
                   </div>
               </div>
            </div>
            </div>';

            if ($comment->sub_cmt) {
                foreach ($comment->sub_cmt as $sub) {
                    if ($sub->provider) {
                        $img_sub = '<img src="' . $sub->avt . '" alt="">';

                    } else {
                        $img_sub = '<img src="' . asset("uploads/avatar/$sub->avt") . '" alt="">';

                    }
                    $result .= '<div class="div_b">
                    <div class="sub_cmt">
                        <div class="c_comment_head">
                            <a href="#">' .
                        $img_sub
                        . '</a>
                        </div>
                        <div>
                            <div class="c_comment_body">
                                <a class="c_comment_user" href="#">' . $sub->user_name . '</a>
                                <p class="c_comment_content">' . $sub->comment_content . '</p>
                                <div>
                                    <p class="c_comment_time">' .date_format(date_create($sub->created_at), 'H:i d/m/Y') . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
               </div> ';

                }

            }
            $result .= '<form action="#" method="GET" class="un_active" id="form_answer_' . $comment->comment_id . '">
            
                <textarea name="comment_' . $comment->comment_id . '" id="comment_' . $comment->comment_id . '" class="comment_a" cols="10" rows="5"></textarea>
                <div class="div_comment">
                    <i class="first-btn ti-comments-smiley" id="btn_' . $comment->comment_id . '"></i>
                    <input type="submit" value="Bình luận" class="btn_submit" id="btn_submit_' . $comment->comment_id . ' data-id="' . $comment->comment_id . '">
                </div>
            </form>
            </li> ';

            $select .= '{
                selector: "#btn_' . $comment->comment_id . '",
                insertInto: "#comment_' . $comment->comment_id . '"
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
                        ' . $select . ' 
                    
                        
                    ], 
                    closeButton: true,
                
                });   
            </script>';
        return $result;
    }

    public function load_comment(Request $request)
    {
        $data['film_id'] = $request->film_id;
        $data['times_load'] = $request->times_load;
        $data['episode'] = $request->episode;
        $list_cmt = Episode_cmt::get_cmt($data['episode'], $data['film_id'], $data['times_load']);
        foreach ($list_cmt as $item) {
            $list_sub_cmt = Sub_episode_cmt::get_sub_cmt($item->comment_id);

            if (sizeof($list_sub_cmt) != 0) {
                $item->sub_cmt = $list_sub_cmt;
            } else {
                $item->sub_cmt = null;

            }
        }
        $result = '';
        $select = '';

        foreach ($list_cmt as $comment) {
            if ($comment->provider) {
                $img = '<img src="' . $comment->avt . '" alt="">';

            } else {
                $img = '<img src="' . asset("uploads/avatar/$comment->avt") . '" alt="">';

            }
            $result .= ' <li>
           <div class="parent_comment">
           <div class="c_comment_head">

               <a href="#">' .
                $img . '
               </a>
           </div>
           <div>
               <div class="c_comment_body">
                   <a class="c_comment_user" href="#">' . $comment->user_name . '</a>
                   <p class="c_comment_content">' . $comment->comment_content . '</p>
                   <div>
                       <p><button href="" class="answer" data-id="' . $comment->comment_id . '" onclick="test1();">Trả lời</button></p>
                       <p class="c_comment_time">' . date_format(date_create($comment->created_at), ' H:i d/m/Y ') . '</p>
                   </div>
               </div>
            </div>
            </div>';

            if ($comment->sub_cmt) {
                foreach ($comment->sub_cmt as $sub) {
                    if ($sub->provider) {
                        $img_sub = '<img src="' . $sub->avt . '" alt="">';

                    } else {
                        $img_sub = '<img src="' . asset("uploads/avatar/$sub->avt") . '" alt="">';

                    }
                    $result .= '<div class="div_b">
                    <div class="sub_cmt">
                        <div class="c_comment_head">
                            <a href="#">' .
                        $img_sub
                        . '</a>
                        </div>
                        <div>
                            <div class="c_comment_body">
                                <a class="c_comment_user" href="#">' . $sub->user_name . '</a>
                                <p class="c_comment_content">' . $sub->comment_content . '</p>
                                <div>
                                    <p class="c_comment_time">' . date_format(date_create($sub->created_at), 'H:i d/m/Y') . '</p>
                                </div>
                            </div>
                        </div>
                    </div>
               </div> ';

                }

            }
            $result .= '<form action="#" method="GET" class="un_active" id="form_answer_' . $comment->comment_id . '">
            
                <textarea name="comment_' . $comment->comment_id . '" id="comment_' . $comment->comment_id . '" class="comment_a" cols="10" rows="5"></textarea>
                <div class="div_comment">
                    <i class="first-btn ti-comments-smiley" id="btn_' . $comment->comment_id . '"></i>
                    <input type="submit" value="Bình luận" class="btn_submit" id="btn_submit_' . $comment->comment_id . ' data-id="' . $comment->comment_id . '">
                </div>
            </form>
            </li> ';

            $select .= '{
                selector: "#btn_' . $comment->comment_id . '",
                insertInto: "#comment_' . $comment->comment_id . '"
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
                        ' . $select . ' 
                    
                        
                    ], 
                    closeButton: true,
                
                });   
            </script>';

        $rs['result'] = $result;
        $rs['total_cmt'] = 0;
        return $rs;

    }


}