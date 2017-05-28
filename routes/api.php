<?php

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'tickets'], function () {
        Route::post('', 'TicketController@store');
        Route::delete('{id}', 'TicketController@delete');
    });

    Route::group(['prefix' => 'departments'], function () {
        Route::get('/', 'DepartmentController@index');
        Route::post('/', 'DepartmentController@create');
        Route::delete('{id}', 'DepartmentController@delete');
    });

    Route::group(['prefix' => 'types'], function () {
        Route::get('/', 'TypeController@index');
    });
});
