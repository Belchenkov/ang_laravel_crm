<?php

Route::group(['prefix' => 'users', 'middleware' => []], function () {
    Route::get('/', 'Api\UserController@index')->name('api.users.index');
    Route::post('/', 'Api\UserController@store')->name('api.users.store');
    Route::get('/{user}', 'Api\UserController@show')->name('api.users.read');
    Route::put('/{user}', 'Api\UserController@update')->name('api.users.update');
    Route::delete('/{user}', 'Api\UserController@destroy')->name('api.users.delete');
});
