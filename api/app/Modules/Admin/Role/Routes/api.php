<?php

Route::group(['prefix' => 'roles', 'middleware' => []], function () {
    Route::get('/', 'Api\RoleController@index')->name('api.roles.index');
    Route::post('/', 'Api\RoleController@store')->name('api.roles.store');
    Route::get('/{role}', 'Api\RoleController@show')->name('api.roles.read');
    Route::put('/{role}', 'Api\RoleController@update')->name('api.roles.update');
    Route::delete('/{role}', 'Api\RoleController@destroy')->name('api.roles.delete');
});