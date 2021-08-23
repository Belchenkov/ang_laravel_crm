<?php

Route::group(['prefix' => 'leads', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\LeadController@index')->name('api.leads.index');
    Route::get('/archive/index', 'Api\LeadController@archive')->name('api.leads.archive');
    Route::get('/{lead}', 'Api\LeadController@show')->name('api.leads.read');
    Route::get('/add-sale/count', 'Api\LeadController@getAddSaleCount')->name('api.leads.get.sale.count');
    Route::post('/', 'Api\LeadController@store')->name('api.leads.store');
    Route::post('/create/check', 'Api\LeadController@checkExist')->name('api.leads.check.exist');
    Route::put('/{lead}', 'Api\LeadController@update')->name('api.leads.update');
    Route::put('/update/quality/{lead}', 'Api\LeadController@updateQuality')->name('api.leads.update.quality');
    Route::delete('/{lead}', 'Api\LeadController@destroy')->name('api.leads.delete');
});
