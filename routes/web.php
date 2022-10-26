<?php

use App\http\Controllers\{DataController, TeknisiController,
                         StatusController, ProdukController, JobdeskController, 
                         PrioritasController, UserController, CommentController};
use App\Http\Controllers\Auth\LoginController;
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
    return view('auth.login');
});

Auth::routes();


// Route user

Route::middleware(['preventBackHistory','auth','user-access:user'])->group(function(){

    //Route::get('home/index', [HomeController::class, 'home'])->name('home');

    Route::get('/logout', [LoginController::class,'logout'])->name('logout'); 
    Route::get('project/add_comment/{id}', [DataController::class,'add_comment'])->name('project.add_comment');   
    Route::get('project/export', 'App\Http\Controllers\DataController@export')->name('project.export');
    Route::resource('project', DataController::class);
});

// Route admin

Route::middleware(['preventBackHistory','auth','user-access:admin'])->group(function(){

    //Route::get('/home', [HomeController::class, 'adminHome'])->name('adminHome');

    Route::delete('project/deleteImage/{id}',[DataController::class,'deleteImage']); 
    Route::get('project/download/{id}', [DataController::class,'download']);   
    Route::get('/logout', [LoginController::class,'logout'])->name('logout');    
    Route::get('project/export', 'App\Http\Controllers\DataController@export')->name('project.export');
    Route::get('project/add_comment/{id}', [DataController::class,'add_comment'])->name('project.add_comment');
    Route::post('project/uploadImage/{id}',[CommentController::class,'uploadImage'])->name('project.uploadImage');
    Route::resource('project', DataController::class);
    Route::resource('teknisi', TeknisiController::class);
    Route::resource('status', StatusController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('jobdesk', JobdeskController::class);
    Route::resource('priority', PrioritasController::class);
    Route::resource('user', UserController::class);
});