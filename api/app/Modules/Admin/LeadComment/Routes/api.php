<?php

Route::group(['prefix' => 'lead-comments', 'middleware' => ['auth:api']], function () {
    Route::post('/', 'Api\LeadCommentController@store')->name('api.lead-comments.store');
});
