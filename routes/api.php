<?php

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
//Route::middleware('cors')->get('v1/login/{provider}', 'LoginController@redirectToProvider');
Route::prefix('v1')->middleware('api')->group(function () {
    Route::get('login/{provider}', 'LoginController@redirectToProvider');
    Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback');
    Route::group(['middleware' => ['jwt.auth']], function () {

        Route::get('article/type', 'ArticleController@getType');
        Route::apiResource('article', 'ArticleController');
        Route::apiResource('article/{article}/comment', 'CommentController', ['except' => ['show']]);


        Route::get('/article/{id}/edit', 'ArticleController@edit');
        //Route::get('/user','HomeController@getTokenData');
        Route::get('/user', 'UserController@getUserData');

        Route::post('logout', 'LoginController@logout');

    });
});;

