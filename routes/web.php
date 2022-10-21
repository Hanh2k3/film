<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// home page  
Route::prefix('/home') -> group( function () {
    Route::get('', [HomeController::class, 'index']);
});

<<<<<<< HEAD
Route::prefix('/test') -> group( function () {
    Route::get('', function () {
        return "Test";
    });
});
=======

>>>>>>> f294502f22a1a70c4f8d13321d08ac01df84f64e
