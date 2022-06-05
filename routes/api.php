<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransportController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Client Model Routing
// Route::get('/clients', [ClientController::class, 'index']);
// Route::post('/add_client', [ClientController::class, 'store']);
// Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::resource('client', ClientController::class);
Route::get('/search_client/{enteredText}', [ClientController::class, 'searchClient']);
Route::get('/search_keyword/{enterText}', [ClientController::class, 'searchUsingKeyword']);

// Item Model Routing
Route::resource('/item', ItemController::class);
Route::get('/search_item/{searchText}', [ItemController::class, 'searchItem']);

// Transport Model Routing 
Route::resource('/transport', TransportController::class);
