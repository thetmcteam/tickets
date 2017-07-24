<?php

Route::group(['middleware' => 'auth'], function () {
    Route::post('invite', 'InviteController@store');
    
    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index');
        Route::post('/', 'TicketController@store');
        Route::post('search', 'TicketController@search');
        Route::delete('{id}', 'TicketController@delete');

        Route::put('{id}/status', 'TicketController@updateStatus');
        Route::put('{id}/priority', 'TicketController@updatePriority');
        Route::put('{id}/assignee', 'TicketController@updateAssignee');
        Route::put('{id}/type', 'TicketController@updateType');
        Route::put('{id}/department', 'TicketController@updateDepartment');
    });

    Route::group(['prefix' => 'departments'], function () {
        Route::get('/', 'DepartmentController@index');
        Route::post('/', 'DepartmentController@create');
        Route::delete('{id}', 'DepartmentController@delete');
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::post('/', 'CommentController@create');
        Route::get('{id}', 'CommentController@find');
        Route::delete('{id}', 'CommentController@delete');
    });

    Route::group(['prefix' => 'metrics'], function () {
        Route::get('types', 'MetricsController@getTicketCountByType');
        Route::get('department', 'MetricsController@getTicketCountsByDepartment');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index');
        Route::post('{id}/activate', 'UserController@activate');
        Route::post('{id}/deactivate', 'UserController@deactivate');
    });

    Route::post('notes', 'NoteController@create');
    Route::get('types', 'TypeController@index');
    Route::get('status', 'StatusController@index');
    Route::get('priorities', 'PriorityController@index');
    Route::get('actions/{id}', 'ActionController@find');
});
