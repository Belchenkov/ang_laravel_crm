<?php

Route::group(['prefix' => 'sources', 'middleware' => []], function () {
    Route::get('/', 'Api\SourcesController@index')->name('api.sources.index');
    Route::post('/', 'Api\SourcesController@store')->name('api.sources.store');
    Route::get('/{source}', 'Api\SourcesController@show')->name('api.sources.read');
    Route::put('/{source}', 'Api\SourcesController@update')->name('api.sources.update');
    Route::delete('/{source}', 'Api\SourcesController@destroy')->name('api.sources.delete');
});