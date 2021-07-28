<?php

Route::group(['prefix' => 'tasks', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\TasksController@index')->name('api.tasks.index');
    Route::get('/{task}', 'Api\TasksController@show')->name('api.tasks.read');
    Route::get('/archive/index', 'Api\TasksController@archive')->name('tasks.archive.index');
    Route::post('/', 'Api\TasksController@store')->name('api.tasks.store');
});
