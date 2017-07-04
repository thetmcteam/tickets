<?php

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'TicketController@index');
        Route::post('/', 'TicketController@store');
        Route::post('search', 'TicketController@search');
        Route::delete('{id}', 'TicketController@delete');

        Route::put('{id}/status', 'TicketController@updateStatus');
        Route::put('{id}/priority', 'TicketController@updatePriority');
        Route::put('{id}/assignee', 'TicketController@updateAssignee');
        Route::put('{id}/type', 'TicketController@updateType');
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

    Route::group(['prefix' => 'notes'], function () {
        Route::post('/', 'NoteController@create');
    });

    Route::group(['prefix' => 'types'], function () {
        Route::get('/', 'TypeController@index');
    });

    Route::group(['prefix' => 'status'], function () {
        Route::get('/', 'StatusController@index');
    });

    Route::group(['prefix' => 'priorities'], function () {
        Route::get('/', 'PriorityController@index');
    });
});
