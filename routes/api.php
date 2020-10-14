<?php

use Illuminate\Http\Request;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'API\AuthController@login');
    Route::post('signup', 'API\AuthController@signUp');
    Route::post('logout', 'API\AuthController@logout');
    Route::post('refresh', 'API\AuthController@refresh');
    Route::post('me', 'API\AuthController@me');
});

Route::apiResource('employees', 'API\EmployeeController');
Route::apiResource('suppliers', 'API\SupplierController');
Route::apiResource('categories', 'API\CategoryController');
Route::apiResource('items', 'API\ItemController');
Route::apiResource('expenses', 'API\ExpenseController');

Route::post('/sallaries/paid/{id}', 'API\SallaryController@paid');
Route::get('/sallaries', 'API\SallaryController@index');
Route::get('/sallaries/{id}', 'API\SallaryController@showData');
Route::get('/sallaries/detail/{id}', 'API\SallaryController@edit');
Route::put('/sallaries/detail/edit/{id}', 'API\SallaryController@update');
