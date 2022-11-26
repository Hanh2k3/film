<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\FilmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ViewFilmController;
use App\Http\Controllers\Client\LoginController; 
use App\Http\Controllers\Client\RegisterController; 
use App\Http\Controllers\Client\InforController;
use App\Http\Controllers\TestController; 
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




// admin 
Route::prefix('/admin') -> name('admin') -> group( function () {
    Route::get('adminPage', [AdminController::class, 'index']);
    Route::resources([
       'category' => CategoryController::class,
       'film' => FilmController::class 
    ]);
}); 









// home page  
Route::prefix('/') -> name('home.')-> group( function () {
    Route::get('/', [HomeController::class, 'index']);
});

// InforFilm 
Route::prefix('/infor') -> name('infor.')-> group( function () {
    Route::get('/{id}', [InforController::class, 'index']) -> name('view');
}); 

// index film 
Route::prefix('/viewPage') -> name('viewPage.') -> group( function () {
    Route::get('/{film_id}/{episode_id}', [ViewFilmController::class, 'index']) ;
});

// login user 
Route::prefix('/login') -> name('login.') -> group( function () {
    Route::get('/', [LoginController::class, 'index']) -> name('index');

    Route::post('/', [LoginController::class, 'login']) -> name('check_login'); 

    Route::prefix('/google') -> group( function () {
        Route::get('/', [LoginController::class, 'login_google']) -> name('login_google');
        Route::get('/redirect', [LoginController::class, 'google_callback']);
        Route::get('/policy', [LoginController::class, 'policy']) -> name('policy');  
    }); 
   
});
Route::prefix('/register') -> name('register.') -> group( function () {
    Route::get('/', [RegisterController::class, 'index']);
    
    Route::post('/insert-user', [RegisterController::class, 'insert_user']) -> name('insert_user');
});

// forget password 
Route::prefix('/forget-password') -> name('forget_password.') -> group( function () {
    Route::get('/', [LoginController::class, 'view_forget_password']);

    Route::post('/', [LoginController::class, 'send_mail_password']);

    Route::get('/change-password/{id}/{token}', [LoginController::class, 'change_password_view']) -> name('change_password_view'); 
    Route::post('/save-change_password', [LoginController::class, 'change_password']) -> name('change_password');
});

Route::get('/test', [TestController::class, 'test_send_mail']);

