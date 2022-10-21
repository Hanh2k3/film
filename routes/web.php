<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\ViewFilmController;
use App\Http\Controllers\InforFilmController; 
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

// InforFilm 
Route::prefix('/infor') -> group( function () {

}); 

// index film 
Route::prefix('/viewPage') -> group( function () {

});




