<?php

Route::group(['prefix' => 'analytics', 'middleware' => []], function () {
    Route::get('/', 'AnalyticsController@index')->name('analytics.index');
    Route::get('/create', 'AnalyticsController@create')->name('analytics.create');
    Route::post('/', 'AnalyticsController@store')->name('analytics.store');
    Route::get('/{analytic}', 'AnalyticsController@show')->name('analytics.read');
    Route::get('/edit/{analytic}', 'AnalyticsController@edit')->name('analytics.edit');
    Route::put('/{analytic}', 'AnalyticsController@update')->name('analytics.update');
    Route::delete('/{analytic}', 'AnalyticsController@destroy')->name('analytics.delete');
});