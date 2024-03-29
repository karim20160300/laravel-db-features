<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('articles', 'App\Http\Controllers\ArticleController@index');
Route::get('DBRawExamples', 'App\Http\Controllers\ArticleController@DBRawExamples');
Route::get('collections', 'App\Http\Controllers\ArticleController@collections');
Route::get('collectionsChunk', 'App\Http\Controllers\ArticleController@collectionsChunk');
Route::post('user_store', 'App\Http\Controllers\UserController@store');
Route::post('article_store', 'App\Http\Controllers\ArticleController@store');
Route::get('article_show', 'App\Http\Controllers\ArticleController@show');