<?php

Route::group(['middleware' => 'invite.pending'], function () {
    Route::post('users', 'UserController@store');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'admin'], function () {
        Route::post('invite', 'InviteController@store');
    });

    Route::group(['prefix' => 'attachments'], function () {
        Route::post('/', 'AttachmentController@create');
        Route::get('{id}', 'AttachmentController@find');
        Route::delete('{id}', 'AttachmentController@delete');
    });

    Route::group(['prefix' => 'authorizations'], function () {
        Route::post('/', 'AuthorizationController@store');
        Route::get('{id}', 'AuthorizationController@show');
        Route::delete('{id}', 'AuthorizationController@delete');
    });
    
    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index');
        Route::post('/', 'TicketController@store');
        Route::post('search', 'TicketController@search');

        Route::group(['middleware' => 'admin'], function () {
            Route::delete('{id}', 'TicketController@delete');
            Route::put('{id}/status', 'TicketController@updateStatus');
            Route::put('{id}/priority', 'TicketController@updatePriority');
            Route::put('{id}/assignee', 'TicketController@updateAssignee');
            Route::put('{id}/type', 'TicketController@updateType');
            Route::put('{id}/department', 'TicketController@updateDepartment');
        });
    });

    Route::group(['prefix' => 'departments'], function () {
        Route::get('/', 'DepartmentController@index');
        
        Route::group(['middleware' => 'admin'], function () {
            Route::post('/', 'DepartmentController@create');
            Route::put('{id}/activate', 'DepartmentController@activate');
            Route::put('{id}/deactivate', 'DepartmentController@deactivate');
            Route::put('{id}/public', 'DepartmentController@makePublic');
            Route::put('{id}/private', 'DepartmentController@makePrivate');
        });
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::post('/', 'CommentController@create');
        Route::get('{id}', 'CommentController@find');
        
        Route::group(['middleware' => 'admin'], function () {
            Route::delete('{id}', 'CommentController@delete');
        });
    });

    Route::group(['prefix' => 'metrics'], function () {
        Route::get('types', 'MetricsController@getTicketCountByType');
        Route::get('department', 'MetricsController@getTicketCountsByDepartment');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index');
        Route::put('{id}', 'UserController@update');
        Route::put('{id}/password', 'UserController@updatePassword');
        Route::post('{id}/activate', 'UserController@activate');
        Route::post('{id}/deactivate', 'UserController@deactivate');
    });

    Route::post('notes', 'NoteController@create');
    Route::get('types', 'TypeController@index');
    Route::get('status', 'StatusController@index');
    Route::get('priorities', 'PriorityController@index');
    Route::get('actions/{id}', 'ActionController@find');
});
