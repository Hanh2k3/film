<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evaluate extends Model
{
    use HasFactory;

    static function check_evaluation($user_id, $film_id)
    {
        $check = DB::table('evaluate_film')->where('user_id', $user_id)->where('film_id', $film_id)->first();
        return $check;
    }

    static function add_evaluation($data)
    {
        DB::table('evaluate_film')->insert($data);
    }

    static function update_evaluation($user_id, $film_id, $evaluate_value)
    {
        DB::table('evaluate_film')->where('user_id', $user_id)->where('film_id', $film_id)->update(['evaluate_value' => $evaluate_value]);
        return true;

    }

    // get evaluate of user 
    static function get_evaluate($user_id, $film_id)
    {
        $value = DB::table('evaluate_film')->where('user_id', $user_id)->where('film_id', $film_id)->select('evaluate_value')->first();
        return $value;
    }

    // get average of valuation film 
    static function get_avg_evaluation($film_id)
    {
        $value = DB::select('select avg(evaluate_value) as score  from evaluate_film where film_id = ?', [$film_id]);
        return $value;
    }

    // check film evaluated 
    static function check_film($film_id)
    {
        $film = DB::table('evaluate_film')->where('film_id', $film_id)->first();
        return $film;
    }


}