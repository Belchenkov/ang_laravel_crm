<?php

Route::group(['prefix' => 'statuses', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\StatusesController@index')->name('api.statuses.index');
});
