<?php

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'AuthController@index')->name('login');
    Route::post('/', 'AuthController@authenticate')->name('login');
    Route::post('ldap', 'AuthController@authenticateAgainstAD')->name('login.ldap');
    Route::get('invite', 'InviteController@index');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', 'UserController@show');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index')->name('tickets');
        Route::get('create', 'TicketController@create')->name('tickets.create');
        Route::get('{id}', 'TicketController@show')->name('tickets.show');
        Route::get('department/{id}', 'TicketController@showByDepartment')->name('tickets.department');
    });

    Route::group(['prefix' => 'users', 'middleware' => 'admin'], function () {
        Route::get('/', function () {
            return view('admin.users');
        })->name('users.all');
    });
});
