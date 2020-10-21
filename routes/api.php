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
Route::apiResource('customers', 'API\CustomerController');

Route::post('/sallaries/paid/{id}', 'API\SallaryController@paid');
Route::get('/sallaries', 'API\SallaryController@index');
Route::get('/sallaries/{id}', 'API\SallaryController@showData');
Route::get('/sallaries/detail/{id}', 'API\SallaryController@edit');
Route::put('/sallaries/detail/edit/{id}', 'API\SallaryController@update');

Route::get('/stocks/{id}', 'API\ItemController@getStock');
Route::put('/stocks/{id}', 'API\ItemController@addStock');

Route::get('/pos/categories/{id}', 'API\PosController@getItemByCategory');
Route::get('/pos/categories', 'API\PosController@getAllCategory');
Route::post('/pos/addsales', 'API\PosController@addSales');


Route::get('/addtocart/{id}', 'API\CartController@addToCart');
Route::get('/cart', 'API\CartController@getCart');
Route::delete('/cart/{id}', 'API\CartController@destroy');
Route::get('/cart/addqty/{id}', 'API\CartController@addQty');
Route::get('/cart/delqty/{id}', 'API\CartController@delQty');
Route::get('/cart/vats', 'API\CartController@getVat');

Route::get('/sales', 'API\OrderController@getTodayOrder');
Route::get('/sales/{id}', 'API\OrderController@getOrderDetail');
Route::get('/sales/detail/{id}', 'API\OrderController@getOrderDetailAll');
Route::post('/sales/search', 'API\OrderController@getSearchOrder');

Route::get('/todaysales', 'HomeController@getDataHome');
Route::get('/stockout', 'HomeController@stockOut');


Route::get('/cekdata', function() {
    return App\Item::with('category')->where('qty', '<', '1')->get();
});


