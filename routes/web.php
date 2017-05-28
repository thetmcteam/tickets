<?php

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'AuthController@index')->name('login');
    Route::post('/', 'AuthController@check')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index')->name('tickets');
        Route::get('create', 'TicketController@create')->name('tickets.create');
    });
});
