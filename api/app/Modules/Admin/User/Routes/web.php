<?php

Route::group(['prefix' => 'users', 'middleware' => []], function () {
    Route::get('/', 'UserController@index')->name('users.index');
    Route::get('/create', 'UserController@create')->name('users.create');
    Route::post('/', 'UserController@store')->name('users.store');
    Route::get('/{user}', 'UserController@show')->name('users.read');
    Route::get('/edit/{user}', 'UserController@edit')->name('users.edit');
    Route::put('/{user}', 'UserController@update')->name('users.update');
    Route::delete('/{user}', 'UserController@destroy')->name('users.delete');
});