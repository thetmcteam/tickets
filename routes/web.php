<?php

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'AuthController@index')->name('login');
    Route::post('/', 'AuthController@check')->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index')->name('tickets');
        Route::get('create', 'TicketController@create')->name('tickets.create');
        Route::get('{id}', 'TicketController@show')->name('tickets.show');
        Route::get('department/{id}', 'TicketController@showByDepartment')->name('tickets.department');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('tickets', 'UserController@tickets')->name('user.tickets');
    });
});
