<?php

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
    return view('welcome');
});

Route::prefix("admin")->group(function () {
    Route::any("/show", "AdminController@show")->name('adminshow');
    Route::any("/showusers", "AdminController@getusers")->name('admingetusers');
    Route::any("/edituser/{id}", "AdminController@edituser")->name('adminedituser');
    Route::any("/update", "AdminController@update")->name('useradminupdate');
    Route::post("/image/upload","ImageController@upload")->name('adminuploadfile');
});

Route::prefix("user")->group(function () {
    Route::any("/show", "SiteController@show")->name('usershow');
    Route::any("/save", "SiteController@save")->name('usersave');
});
