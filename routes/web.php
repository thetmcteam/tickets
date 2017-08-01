<?php

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'AuthController@index')->name('login');
    Route::post('/', 'AuthController@authenticate')->name('login');
    Route::post('ldap', 'AuthController@authenticateAgainstAD')->name('login.ldap');
    Route::get('invite', 'InviteController@index');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('user', 'UserController@show')->name('user.profile');
    Route::get('user/settings', 'UserController@edit')->name('user.settings');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index')->name('tickets');
        
        Route::get('create', function () {
            return view('tickets.create');
        })->name('tickets.create');

        Route::get('{id}', 'TicketController@show')->name('tickets.show');
        Route::get('department/{id}', 'TicketController@showByDepartment')->name('tickets.department');
    });

    Route::get('departments', function () {
        return view('admin.departments');
    })
        ->middleware('admin')
        ->name('departments.all');

    Route::get('users', function () {
        return view('admin.users');
    })
        ->middleware('admin')
        ->name('users.all');
});
