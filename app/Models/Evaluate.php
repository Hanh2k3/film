<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evaluate extends Model
{
    use HasFactory; 

    static function check_evaluation($user_id, $film_id) {
        $check = DB::table('evaluate_film') -> where('user_id', $user_id) -> where('film_id', $film_id) -> first();
        return $check ; 
    }

    static function add_evaluation($data) {
        DB::table('evaluate_film')-> insert($data); 
    }

    static function update_evaluation($user_id, $film_id, $evaluate_film) {
        DB::table('evaluate_film')-> where('user_id', $user_id) -> where('film_id', $film_id) -> update(['evaluate_film' => $evaluate_film]);
        return true; 

    }
}
