<?php

Route::group(['prefix' => 'roles', 'middleware' => []], function () {
    Route::get('/', 'RoleController@index')->name('roles.index');
    Route::get('/create', 'RoleController@create')->name('roles.create');
    Route::post('/', 'RoleController@store')->name('roles.store');
    Route::get('/{role}', 'RoleController@show')->name('roles.read');
    Route::get('/edit/{role}', 'RoleController@edit')->name('roles.edit');
    Route::put('/{role}', 'RoleController@update')->name('roles.update');
    Route::delete('/{role}', 'RoleController@destroy')->name('roles.delete');
});

Route::group(['prefix' => 'permissions', 'middleware' => []], function () {
    Route::get('/', 'PermissionController@index')->name('permissions.index');
    Route::get('/create', 'PermissionController@create')->name('permissions.create');
    Route::post('/', 'PermissionController@store')->name('permissions.store');
    Route::get('/{role}', 'PermissionController@show')->name('permissions.read');
    Route::get('/edit/{role}', 'PermissionController@edit')->name('permissions.edit');
    Route::put('/{role}', 'PermissionController@update')->name('permissions.update');
    Route::delete('/{role}', 'PermissionController@destroy')->name('permissions.delete');
});
