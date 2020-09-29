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

//Route::get('/', function (Request $request) {
//    return dd($request->all());
//});

Route::get('/', 'Blog\BlogController@index')->name('blog');
Route::get('/post/{post}', 'Blog\BlogController@show')->name('show');

Auth::routes();

Route::prefix('/author')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('/posts', 'Author\PostsController');

});
