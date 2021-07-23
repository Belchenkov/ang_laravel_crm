<?php

Route::group(['prefix' => 'analytics', 'middleware' => []], function () {
    Route::post('/', 'Api\AnalyticsController@index')->name('api.analytics.index');
});
