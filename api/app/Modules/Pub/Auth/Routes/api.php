<?php

Route::group(['prefix' => 'auth', 'middleware' => []], function () {
    Route::post('/login', 'Api\LoginController@login')->name('api.auth.login');
});
