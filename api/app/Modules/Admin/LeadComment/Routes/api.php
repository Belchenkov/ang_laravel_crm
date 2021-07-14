<?php

Route::group(['prefix' => 'lead-comments', 'middleware' => []], function () {
    Route::get('/', 'Api\LeadCommentController@index')->name('api.lead-comments.index');
    Route::post('/', 'Api\LeadCommentController@store')->name('api.lead-comments.store');
    Route::get('/{leadComment}', 'Api\LeadCommentController@show')->name('api.lead-comments.read');
    Route::put('/{leadComment}', 'Api\LeadCommentController@update')->name('api.lead-comments.update');
    Route::delete('/{leadComment}', 'Api\LeadCommentController@destroy')->name('api.lead-comments.delete');
});