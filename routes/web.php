<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');  
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/archive/{id}','InvoiceController@restore')->name('restore');
Route::get('/status_show/{id}','InvoiceController@status_show')->name('show');
Route::get('/print_invoice/{id}','InvoiceController@print_invoice')->name('print_invoice');
Route::POST('/status_update/{id}','InvoiceController@status_update')->name('status_update');
Route::get('/archive','InvoiceController@archive')->name('archive');
Route::get('/invoice_paid','InvoiceController@paid')->name('paid');
Route::get('/invoice_unpaid','InvoiceController@unpaid')->name('unpaid');
Route::get('/invoice_partial_paid','InvoiceController@partial_paid')->name('partial_paid');




Route::resource('invoices','InvoiceController');
Route::resource('sections','SectionController');
Route::resource('products','ProductController');
Route::POST('/invoice/{id}','InvoiceController@update')->name('invoices.update');
Route::get('/section/{id}','InvoiceController@getproducts');
Route::get('invoicesDetails/{section_id}','InvoiceDetaileController@index');
Route::get('Export/invoices','InvoiceController@excel')->name('Export.excel');
Route::get('/{page}', 'AdminController@index');


Route::get('view_file/{invoice_id}/{file_name}','InvoiceDetaileController@open_file');
Route::get('download/{invoice_id}/{file_name}','InvoiceDetaileController@get_file');
Route::POST('delete_file','InvoiceDetaileController@destroy')->name('delete_file');
Route::POST('store_attachment','InvoiceDetaileController@store_attachment')->name('store_attachment');


//users
Route::get('/{page}', 'UserController@index');

