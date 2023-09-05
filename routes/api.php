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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/{password}', [QuotesController::class, 'getUser']);
Route::middleware('auth:api')->get('favourite', [QuotesController::class, 'listAllFavourite'])->name('favourite');
Route::middleware('auth:api')->get('quotes/{number}/{refresh?}', [QuotesController::class, 'listSpecificQuotes'])->name('quotes');

Route::middleware('auth:api')->delete('favourite/{id}', [QuotesController::class, 'deleteFavouriteApi'])->name('favourite');

Route::middleware('auth:api')->post('favourite/{markedFavourite}', [QuotesController::class, 'saveFavouriteQuotesApi'])->name('favourite');
