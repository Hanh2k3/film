<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    static function listCategory()
    {
        $get = DB::table('categories')->get();
        return $get;
    }

    static function get_category($id) {
        $category = DB::table('categories') -> where('category_id', $id) -> first();
        return $category;
    }
}
