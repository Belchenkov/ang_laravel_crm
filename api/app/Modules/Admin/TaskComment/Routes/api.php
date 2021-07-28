<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tasks-comments', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\TasksCommentsController@index')->name('api.tasks_comments.index');
    Route::post('/', 'Api\TasksCommentsController@store')->name('api.tasks_comments.store');
});
