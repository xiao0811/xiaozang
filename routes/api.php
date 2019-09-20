<?php

use Illuminate\Http\Request;

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

Route::get("/login", "UserController@nameLogin")->name("login");

Route::group(["prefix" => "account"], function () {
    Route::post("preregister", "UserController@preregister");
    Route::post("refreshToken", "UserController@refreshToken");
    Route::post("login", "UserController@login");

    // 添加中间件
    Route::group(["middleware" => "auth:api"], function () {
        Route::get("getDetails", "UserController@getDetails");
    });
});


Route::group(["prefix" => "banner"], function () {
    Route::get("/{id?}", "BannerController@index");

    Route::group([], function () {
        Route::post("/", "BannerController@store");
        Route::put("/{id}", "BannerController@update");
        Route::delete("/{id}", "BannerController@delete");
    });
});
