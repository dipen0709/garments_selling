<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home',      array('as' => 'home',      'routegroup' => 'dashboard','uses' => 'DashboardController@index'));
Route::get('/dashboard', array('as' => 'dashboard', 'routegroup' => 'dashboard','uses' => 'DashboardController@index'));

Route::get('/customer', array('as' => 'customer', 'routegroup' => 'customer','uses' => 'CustomerController@index'));

Route::get('/customer', array('as' => 'customer', 'searchtype' => '3', 'routegroup' => 'customer', 'uses' => 'CustomerController@index'));
Route::get('/customer/create', array('as' => 'customer.create', 'routegroup' => 'customer', 'uses' => 'CustomerController@create'));
Route::post('/customer/store', array('as' => 'customer.store', 'routegroup' => 'customer','uses' => 'CustomerController@store'));
Route::get('/customer/{id}/edit', array('as' => 'customer.edit', 'routegroup' => 'profile','uses' => 'CustomerController@edit'));
Route::get('/customer/{id}/delete', array('as' => 'customer.delete', 'routegroup' => 'customer', 'uses' => 'CustomerController@delete'));
Route::post('/customer/update', array('as' => 'customer.update', 'routegroup' => 'customer', 'uses' => 'CustomerController@update'));

Route::get('/stock', array('as' => 'stock', 'routegroup' => 'stock','uses' => 'StockController@index'));
Route::get('/stock', array('as'=>'stock','searchtype'=>'3','routegroup'=>'stock','uses' => 'StockController@index'));
Route::get('/stock/create', array('as' => 'stock.create', 'routegroup' => 'stock', 'uses' => 'StockController@create'));
Route::post('/stock/store', array('as' => 'stock.store', 'routegroup' => 'stock','uses' => 'StockController@store'));
Route::get('/stock/{id}/edit', array('as' => 'stock.edit', 'routegroup' => 'profile','uses' => 'StockController@edit'));
Route::get('/stock/{id}/delete', array('as' => 'stock.delete', 'routegroup' =>'stock','uses' => 'StockController@delete'));
Route::post('/stock/update', array('as' => 'stock.update', 'routegroup' => 'stock', 'uses' => 'StockController@update'));

Route::get('/bill', array('as' => 'bill', 'routegroup' => 'bill','uses' => 'BillController@index'));
Route::get('/bill', array('as'=>'bill','searchtype'=>'3','routegroup'=>'bill','uses' => 'BillController@index'));
Route::get('/bill/create', array('as' => 'bill.create', 'routegroup' => 'bill', 'uses' => 'BillController@create'));
Route::post('/bill/store', array('as' => 'bill.store', 'routegroup' => 'bill','uses' => 'BillController@store'));
Route::get('/bill/{id}/edit', array('as' => 'bill.edit', 'routegroup' => 'profile','uses' => 'BillController@edit'));
Route::get('/bill/{id}/delete', array('as' => 'bill.delete', 'routegroup' =>'bill','uses' => 'BillController@delete'));
Route::post('/bill/update', array('as' => 'bill.update', 'routegroup' => 'bill', 'uses' => 'BillController@update'));

Route::post('/add-cloth', array('as' => 'add.cloth', 'uses' => 'HomeController@addCloth'));

Route::get('/sizewithprice', array('as' => 'sizewithprice', 'searchtype' => '4','routegroup' => 'sizewithprice', 'uses' => 'SizeWithPriceController@index'));
Route::get('/sizewithprice/create', array('as' => 'sizewithprice.create','routegroup' => 'sizewithprice', 'uses' => 'SizeWithPriceController@create'));
Route::post('/sizewithprice/store', array('as' => 'sizewithprice.store','routegroup' => 'sizewithprice', 'uses' => 'SizeWithPriceController@store'));
Route::get('/sizewithprice/{id}/edit', array('as' => 'sizewithprice.edit','routegroup' => 'sizewithprice', 'uses' => 'SizeWithPriceController@edit'));
Route::get('/sizewithprice/{id}/delete', array('as' => 'sizewithprice.delete','routegroup' => 'sizewithprice', 'uses' => 'SizeWithPriceController@delete'));
Route::post('/sizewithprice/update/{id}', array('as' => 'sizewithprice.update','routegroup' => 'sizewithprice', 'uses' => 'SizeWithPriceController@update'));