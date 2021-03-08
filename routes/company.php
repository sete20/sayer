<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'company-panel','as' => 'company.'], function () {

    // company Login
    Route::get('/login', 'HomeController@login')->name('login');
    Route::post('/login', 'HomeController@login_post')->name('login.post');

    // company Change Lang
    Route::get('/lang/{lang}', 'HomeController@lang')->name('lang');

    // company Home
    Route::group(['middleware' => 'company.auth'], function () {
        Route::get('/', 'HomeController@home')->name('home');
    });
});
