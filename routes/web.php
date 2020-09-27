<?php

use Illuminate\Support\Facades\Route;
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

Route::post('/', function (Request $request) {
    return dd($request->all());
});

Auth::routes();

Route::prefix('/author')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/posts', 'Author\PostsController');
});
