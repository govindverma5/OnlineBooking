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


Route::get('/', 'DashboardController@index')->name('addevent');
Route::get('/book-list/{id}', 'DashboardController@show')->name('show');
Route::get('/author-book-list/{id}', 'DashboardController@authorBook')->name('authorBook');
Route::get('/category-book-list/{id}', 'DashboardController@categoryBook')->name('categoryBook');


Auth::routes([]);


// Route::middleware('auth','admin')->group(function () {

    
// });

Route::middleware(['middleware' => 'auth'])->group(function () {
    Route::post('/add-review', 'DashboardController@store')->name('addReview');
});

// Route::get('/home', 'HomeController@index')->name('home');





