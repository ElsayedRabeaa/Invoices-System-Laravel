<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DetailsInvoicesController;
use App\Http\Controllers\DropDownConroller;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ReportController;



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
    return view('auth.login');
});



Auth::routes();

// Auth::routes(['register' => false]);


Route::get('/home', 'HomeController@index')->name('home');

Route::resource('invoices', 'InvoicesController');

Route::resource('sections', 'SectionController');

Route::resource('products', 'ProductsController');

Route::resource('InvoiceAttachments', 'InvoiceAttachmentsController');
Route::get('ReportInvoices', 'ReportController@index');


Route::Post('Search_invoices', 'ReportController@search');

Route::get('customers_report', 'ReportController@customer');
Route::get('Search_customers', 'ReportController@Search_customers');




//Route::resource('InvoicesDetails', 'InvoicesDetailsController');

Route::get('/section/{id}', 'InvoicesController@getproducts');

Route::get('/edit_invoice/{id}', 'InvoicesController@edit');


Route::get('/Invoice_Paid', 'InvoicesController@Invoice_Paid');
Route::get('/Invoice_unPaid', 'InvoicesController@Invoice_unPaid');
Route::get('/Invoice_Partial', 'InvoicesController@Invoice_Partial');

Route::resource('/archievs', 'ArchiveController');

Route::get('/Print_invoice/{id}', 'InvoicesController@print');

Route::get('/markall', 'InvoicesController@markall');




Route::get('/Status_show/{id}', 'InvoicesController@show')->name("Status_show");
Route::get('/Status_Update/{id}', 'InvoicesController@Status_Update')->name("Status_Update");

Route::get('export', 'InvoicesController@export');



// Route::get('/dropdownlist/{id}', 'InvoicesController@dropdownlist');



Route::get('/invoicesdetails/{id}', 'DetailsInvoicesController@index');





// Route::get('invoices/ShippingPrices/{country_id}', 'ShippingPriceController@GetCities');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    });

Route::get('/{page}', 'AdminController@index');


