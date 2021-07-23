<?php

Route::group(['prefix' => 'analytics', 'middleware' => []], function () {
    Route::get('/export/{user}/{date_start}/{date_end}', 'AnalyticsController@export')
        ->name('analytics.export');
});
