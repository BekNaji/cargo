<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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


Route::middleware(['auth','lang'])->prefix('dashboard')->as('admin.')->namespace('Admin')->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('user','UserController');
    Route::resource('role','RoleController');
    Route::resource('permission','PermissionController');
    Route::resource('branch','BranchController');
    Route::resource('sender','SenderController');
    Route::resource('receiver','ReceiverController');
    Route::resource('item','ItemController');
    Route::resource('baza','BazaController');
    Route::resource('status','StatusController');
    Route::resource('cargo','CargoController');
    Route::resource('shipping','ShippingController');
    Route::resource('category','CategoryController');
    Route::resource('box','BoxController');
    Route::resource('smsconfig','SmsConfigController');

    Route::get('change/status/index','ChangeStatusController@index')->name('change.status.index');
    Route::post('change/status/byid','ChangeStatusController@byId')->name('change.status.byid');
    Route::post('change/status/bynumber','ChangeStatusController@byNumber')->name('change.status.bynumber');


    Route::get('print/box/{id?}','PrintController@box')->name('print.box');
    Route::get('print/cargo/{id?}','PrintController@cargo')->name('print.cargo');
    Route::get('print/shipping/{id?}','PrintController@shipping')->name('print.shipping');

    Route::get('excell/index','MakeExcellController@index')->name('excell.index');
    Route::post('excell/make','MakeExcellController@make')->name('excell.make');

    Route::get('paginate/change',function(Request $request){
        session(['paginate'=>$request->paginate_number]);
        return back();
    })->name('paginate.change');

    Route::get('test','TestController@index')->name('test');
});

Route::get('change/lang/{locale}',function($locale){
    session(['locale'=> $locale]);
    return back();
})->name('change.lang');
