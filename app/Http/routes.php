<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::post('/', 'ApiController@searchImage');
Route::get('/{fileUUID}', 'ApiController@getImage');
