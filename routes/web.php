<?php

use App\http\Controllers\{HomeController, ProjectController, TeknisiController,
                         StatusController, ProdukController, JobdeskController, 
                         PrioritasController, UserController,AuthController};
use Illuminate\Support\Facades\Route;

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
    return view('home.welcome');
});

Auth::routes();


// Route user

Route::middleware(['auth','user-access:user'])->group(function(){

    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

// disable for a while

// Route manager

// Route::middleware(['auth','user-access:user'])->group(function(){

//     Route::get('/', [HomeController::class, 'index'])->name('home');

//     Route::resource('project', ProjectController::class);
    
// });


// Route admin

Route::middleware(['auth','user-access:admin'])->group(function(){

    Route::get('/home', [HomeController::class, 'adminHome'])->name('adminHome');

    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    Route::get('project/autocomplete','App\Http\Controllers\ProjectController@autocomplete')->name('project.autocomplete');
    Route::get('project/export', 'App\Http\Controllers\ProjectController@export')->name('project.export');
    Route::resource('project', ProjectController::class);
    Route::resource('teknisi', TeknisiController::class);
    Route::resource('status', StatusController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('jobdesk', JobdeskController::class);
    Route::resource('priority', PrioritasController::class);
    Route::resource('user', UserController::class);
});




// Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');

// Route::post('proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
// Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

// Route::group(['middleware' => ['auth']], function(){
//     Route::group(['middleware' => ['cek_login::admin']], function(){
//         Route::resource('project', ProjectController::class);
//         Route::resource('teknisi', TeknisiController::class);
//         Route::resource('status', StatusController::class);
//         Route::resource('produk', ProdukController::class);
//         Route::resource('jobdesk', JobdeskController::class);
//         Route::resource('priority', PrioritasController::class);
//     });
//     Route::group(['middleware' => ['cek_login::editor']], function(){
//         Route::resource('project', ProjectController::class)->except('create','store','edit','update','destroy');
//     });
// });


// Auth::routes();
