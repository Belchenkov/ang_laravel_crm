<?php

Route::group(['prefix' => 'menus', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\MenuController@index')->name('api.menus.index');
});
