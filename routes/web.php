<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\FormRequestController;
use App\Http\Controllers\GetAjaxController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserDetailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::middleware(['auth'])->group(function () {
    Route::controller(HomeController::class)->group(function (){
        Route::get('home', 'index')->name('home');
        Route::get('profile', 'myProfile')->name('profile');
        Route::post('profile', 'storeProfile')->name('sub_profile');
    });

    Route::controller(BookController::class)->group(function () {
        Route::get('books', 'index')->name('books');
        Route::post('store_book', 'store')->name('store_book');
//        Route::post('edit_book/{id}', 'update')->name('edit_book');
        Route::get('delete_book/{id}', 'destroy')->name('delete_book');
        Route::get('delete_all_book/{id}', 'destroyAll')->name('delete_all_book');
    });

    Route::controller(BookRequestController::class)->group(function () {
        Route::get('requests', 'index')->name('requests');
        Route::post('store_request', 'store')->name('store_request');
        Route::post('edit_request/{id}', 'update')->name('edit_request');
        Route::get('delete_request/{id}', 'destroy')->name('delete_request');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users');
        Route::post('store_user', 'store')->name('store_user');
        Route::post('edit_user/{id}', 'update')->name('edit_user');
        Route::get('delete_user/{id}', 'destroy')->name('delete_user');
    });

    Route::controller(UserDetailController::class)->group(function () {
        Route::get('user_details', 'index')->name('user_details');
        Route::post('store_user_details', 'store')->name('store_user_details');
        Route::get('delete_user_details/{id}', 'destroy')->name('delete_user_details');
    });

//    Route::controller(HistoryController::class)->group(function () {
//        Route::get('histories', 'index')->name('histories');
//        Route::get('add_history', 'create')->name('add_history');
//        Route::post('store_history', 'store')->name('store_history');
//        Route::post('edit_history/{id}', 'update')->name('edit_history');
//        Route::get('delete_history/{id}', 'destroy')->name('delete_history');
//    });

    Route::controller(FormRequestController::class)->group(function () {
        // Modal Create Route
        Route::get('create-modal/{id}', 'getCreateModalData')->name('create-modal');

        // Modal Edit Route
        Route::get('edit-modal/{form}/{id}', 'getEditModalData');

        // Modal view Route
        Route::get('view-modal/{form}/{id}', 'getViewModalData');

        // Modal delete Route
        Route::get('delete-modal/{data}/{id}', 'getDeleteModalData');
    });

    Route::controller(GetAjaxController::class)->group(function (){
        Route::post('/get-books-title', 'getBooksDataList');
    });

});

