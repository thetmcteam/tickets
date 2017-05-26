<?php

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'AuthController@index')->name('login');
    Route::post('/', 'AuthController@check')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index');
        Route::get('create', 'TicketController@create');
    });
});
