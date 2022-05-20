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

Route::get('collectionsChunk', 'App\Http\Controllers\ArticleController@collectionsChunk');
Route::get('collectionsRandomArticle', 'App\Http\Controllers\ArticleController@collectionsRandomArticle');
Route::get('getTheMostBlogedUser', 'App\Http\Controllers\ArticleController@getTheMostBlogedUser');