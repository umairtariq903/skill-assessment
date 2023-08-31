<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuotesController;

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

Route::post('showQuotes', [QuotesController::class, 'showQuotes'])->name('showQuotes');
Route::post('markAsFavourite', [QuotesController::class, 'saveFavouriteQuotes'])->name('markAsFavourite');
Route::get('showFavourite', [QuotesController::class, 'showFavourite'])->name('showFavourite');
Route::post('deleteFavourite', [QuotesController::class, 'deleteFavourite'])->name('deleteFavourite');

