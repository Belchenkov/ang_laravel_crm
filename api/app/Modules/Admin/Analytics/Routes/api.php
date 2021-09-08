<?php

Route::group(['prefix' => 'analytics', 'middleware' => ['auth:api']], function () {
    Route::post('/', 'Api\AnalyticsController@index')->name('api.analytics.index');
});
