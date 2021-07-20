<?php

Route::group(['prefix' => 'lead-comments', 'middleware' => []], function () {
    Route::post('/', 'Api\LeadCommentController@store')->name('api.lead-comments.store');
});
