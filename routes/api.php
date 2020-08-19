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

Route::namespace('API')->group(function () {
    Route::post('/users/login', 'AuthController@login');
    Route::post('/users/logout', 'AuthController@logout');

    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::group(['prefix'=> 'categories'], function()
        {
            Route::get('/', 'CategoriesController@index');
        });

        Route::group(['prefix'=> 'products'], function()
        {
            Route::get('/', 'ProductsController@index');
            Route::post('/store', 'ProductsController@store');
            Route::delete('/destroy/{id}', 'ProductsController@destroy');
        });

        Route::group(['prefix'=> 'kits'], function()
        {
            Route::get('/', 'KitsController@index');
            Route::post('/store', 'KitsController@store');
            Route::delete('/destroy/{id}', 'KitsController@destroy');

        });
    });
});
