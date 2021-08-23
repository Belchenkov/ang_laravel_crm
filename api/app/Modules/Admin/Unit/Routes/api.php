<?php

Route::group(['prefix' => 'units', 'middleware' => []], function () {
    Route::get('/', 'Api\UnitsController@index')->name('api.units.index');
});
