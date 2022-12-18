<?php

use App\Models\Store;
use App\Models\Category; 
use App\Models\Film; 

    function test() {
        echo "Hello"; 
    }

    function checkFollowedFilm($film_id) {
        return Store::checkFollowedFilm(session('user_id'), $film_id);
    }

    function listCategory() {
        $list_category = Category::listCategory();
        return $list_category;
    }

    function listYear() {
        $list_year = Film::get_listYear();
        $year = null; 
        $i = 0 ; 
        foreach ($list_year as $item) {
            $year[$i] = date_format(date_create($item->release_date), 'Y');
            $i ++ ; 
        }
        
        for($t=0; $t< sizeof($year) -1; $t++) {
            for($u=$t+1; $u<sizeof($year); $u++ ) {
                if($year[$t] <= $year[$u]) {
                    $temp = $year[$t];
                    $year[$t] = $year[$u];
                    $year[$u] = $temp; 
                }
            }
        }   
        $i=0; 
        $result[0] = $year[0]; 
        for($t=1; $t< sizeof($year); $t++) {
            if($year[$t] != $year[$t-1]) {
                $result[$t+1] = $year[$t];
            }
        }
        
        return $result; 
    }
?>