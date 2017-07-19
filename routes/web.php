<?php

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', 'AuthController@index')->name('login');
    Route::post('/', 'AuthController@authenticate')->name('login');
    Route::post('ldap', 'AuthController@authenticateAgainstAD')->name('login.ldap');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', 'AuthController@logout')->name('logout');
    
    Route::get('dashboard', function () {
        $ticket = \App\Models\Ticket::class;
        $replies = \App\Models\Comment::class;
        return view('admin.dashboard')->withTicket($ticket)->withReplies($replies);
    })->name('dashboard');

    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index')->name('tickets');
        Route::get('create', 'TicketController@create')->name('tickets.create');
        Route::get('{id}', 'TicketController@show')->name('tickets.show');
        Route::get('department/{id}', 'TicketController@showByDepartment')->name('tickets.department');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('tickets', 'UserController@tickets')->name('user.tickets');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', function () {
            return view('admin.users');
        })->name('users.all');
    });
});
