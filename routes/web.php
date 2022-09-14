<?php

use App\http\Controllers\{HomeController, DataController, TeknisiController,
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

    Route::get('home/index', [HomeController::class, 'home'])->name('home');
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');    
    Route::get('project/index','App\Http\Controllers\DataController@index')->name('project.index');
});

// Route admin

Route::middleware(['auth','user-access:admin'])->group(function(){

    Route::get('/home', [HomeController::class, 'adminHome'])->name('adminHome');

    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    Route::get('project/autocomplete','App\Http\Controllers\DataController@autocomplete')->name('project.autocomplete');
    Route::get('project/export', 'App\Http\Controllers\DataController@export')->name('project.export');
    Route::resource('project', DataController::class);
    Route::resource('teknisi', TeknisiController::class);
    Route::resource('status', StatusController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('jobdesk', JobdeskController::class);
    Route::resource('priority', PrioritasController::class);
    Route::resource('user', UserController::class);
});