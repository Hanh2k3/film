<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ViewFilmController;
use App\Http\Controllers\Client\LoginController; 
use App\Http\Controllers\Client\RegisterController; 
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


// admin 
Route::prefix('admin') -> name('admin') -> group( function () {

}); 







// home page  
Route::prefix('/home') -> group( function () {
    Route::get('', [HomeController::class, 'index']);
});

// InforFilm 
Route::prefix('/infor') -> group( function () {
    Route::get('/', function() {
        return view('clients.infor', ["details" => $details = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15]]);
    });
}); 

// index film 
Route::prefix('/viewPage') -> group( function () {
    Route::get('', [ViewFilmController::class, 'index']);
});

// login user 
Route::prefix('/login') -> name('login.') -> group( function () {
    Route::get('/', [LoginController::class, 'index']);
    
});
Route::prefix('/register') -> name('register.') -> group( function () {
    Route::get('/', [RegisterController::class, 'index']);
});




