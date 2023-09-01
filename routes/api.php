<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuotesController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('getFavourite', [QuotesController::class, 'listAllFavourite'])->name('getFavourite');
Route::middleware('auth:api')->get('getQuotes/{number}', [QuotesController::class, 'listSpecificQuotes'])->name('getQuotes');

Route::middleware('auth:api')->post('deleteFavourite/{id}', [QuotesController::class, 'deleteFavouriteApi'])->name('deleteFavourite');
