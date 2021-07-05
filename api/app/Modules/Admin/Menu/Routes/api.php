<?php

Route::group(['prefix' => 'menus', 'middleware' => []], function () {
    Route::get('/', 'Api\MenuController@index')->name('api.menus.index');
    Route::post('/', 'Api\MenuController@store')->name('api.menus.store');
    Route::get('/{menu}', 'Api\MenuController@show')->name('api.menus.read');
    Route::put('/{menu}', 'Api\MenuController@update')->name('api.menus.update');
    Route::delete('/{menu}', 'Api\MenuController@destroy')->name('api.menus.delete');
});