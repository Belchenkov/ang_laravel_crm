<?php

Route::group(['prefix' => 'menus', 'middleware' => []], function () {
    Route::get('/', 'MenuController@index')->name('menus.index');
    Route::get('/create', 'MenuController@create')->name('menus.create');
    Route::post('/', 'MenuController@store')->name('menus.store');
    Route::get('/{menu}', 'MenuController@show')->name('menus.read');
    Route::get('/edit/{menu}', 'MenuController@edit')->name('menus.edit');
    Route::put('/{menu}', 'MenuController@update')->name('menus.update');
    Route::delete('/{menu}', 'MenuController@destroy')->name('menus.delete');
});