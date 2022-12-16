<?php

use App\Models\Store;
use App\Models\Category; 

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
?>