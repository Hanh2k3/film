<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\EpisodeController;
use App\Http\Controllers\admin\FilmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ViewFilmController;
use App\Http\Controllers\Client\LoginController; 
use App\Http\Controllers\Client\RegisterController; 
use App\Http\Controllers\Client\InforController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\StoreController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Client\ListFilmController;
use App\Http\Controllers\Client\SearchController;
use Illuminate\Http\Request;

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
Route::prefix('admin') -> name('admin') -> group( function () {
    Route::get('/index', [AdminController::class, 'index'])->name('index');
    Route::prefix('user')->name('user.')->group(function () {
        Route::delete('/', [AdminController::class, 'deleteUser'])->name('delete');
    });
    Route::resources([
       'category' => CategoryController::class,
       'film' => FilmController::class,
       'episode' => EpisodeController::class,
    ]);
    Route::get('create/{film_id}', [EpisodeController::class, 'createEpisode'])->name('create_episode');
}); 








// home page  
Route::prefix('/') -> name('home.')-> group( function () {
    Route::get('/', [HomeController::class, 'index']);
});

// InforFilm 
Route::prefix('/infor') -> name('infor.')-> group( function () {
    Route::get('/{id}', [InforController::class, 'index']) -> name('view');
    Route::delete('/unfollowFilm/{film_id}', [InforController::class, 'unfollowFilm']) -> name('unfollow');
}); 
 // evaluate film 
 Route::get('/danh-gia', [InforController::class, 'evaluate_film']) -> name('evaluate');
 // comment film 
Route::get('/comment', [InforController::class, 'save_comment']) -> name('save_comment'); 
// load_comment 
Route::get('/load_comment', [InforController::class, 'load_comment']) -> name('load_comment'); 



// Film Store
Route::prefix('/store') -> name('store.') -> group( function() {
    Route::get('/', [StoreController::class, 'index'])->name('index');
    Route::post('/', [StoreController::class, 'insert'])->name('insert');
    Route::delete('/delete/{film_id}', [StoreController::class, 'delete'])->name('delete');
});

//Profile
Route::prefix('/profile')->name('profile.')->group( function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::post('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('update_avatar');
    Route::post('/update-user', [ProfileController::class, 'updateUser'])->name('update_user');
});


// index film 
Route::prefix('/viewPage') -> name('viewPage.') -> group( function () {
    Route::get('/{film_id}/{episode_id}', [ViewFilmController::class, 'index']) ;
});
// index film comments 
Route::get('/view_page_comment', [ViewFilmController::class, 'save_comment']) -> name('save_comment_view') ;
Route::get('/view_page_comment_load', [ViewFilmController::class, 'load_comment']) -> name('load_comment_view') ;


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
// logout user
Route::get('/logout', [LoginController::class, 'logout']) -> name('logout');

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

// category film 
Route::prefix('category_film') -> name('category_film') -> group( function () {
    Route::get('list/{id}', [ListFilmController::class, 'list_film_category']) -> name('list_film_category');
});

// search film 
Route::get('search_film', [SearchController::class, 'index']) -> name('search_film');
Route::get('filter_by_year', [SearchController::class, 'filter_by_year'])->name('filter_by_year'); 

Route::get('/test', [TestController::class, 'test_icon']);

// Route::get('/user', function () {
//     echo session('user_id');
// });
Route::get('/test', [AdminController::class, 'index']);