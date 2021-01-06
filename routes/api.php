<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('\App\Http\Controllers')->group(function () {
    Route::get('/admin/ajax/get-clients', 'AdminAjaxController@getClients')->name('clients_ajax');
    Route::get('/admin/ajax/get-companies', 'AdminAjaxController@getCompanies')->name('companies_ajax');

    Route::middleware('api.auth')->group(function () {
        Route::get('companies', 'RestController@getCompanies');
        Route::get('clients/{id}', 'RestController@getClients')
            ->where('id', '[0-9]+');
        Route::get('client_companies/{id}', 'RestController@getClientCompanies')
            ->where('id', '[0-9]+');
    });
});
