<?php

use App\Models\Store;

    function test() {
        echo "Hello"; 
    }

    function checkFollowedFilm($film_id) {
        return Store::checkFollowedFilm(session('user_id'), $film_id);
    }
?>