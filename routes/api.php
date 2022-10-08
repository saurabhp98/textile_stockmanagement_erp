<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransportController;
use App\Models\Purchase;
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

// purchase model api
Route::resource('/purchase', PurchaseController::class);
Route::get('/search_purchase', [PurchaseController::class, 'searchPurchase']);


// Stock model api
Route::resource('/stock', StockController::class);
Route::get('/search_stock/{search_text}', [StockController::class, 'searchStock']);

// Stock Operations
Route::get('/get_sold_stock_mtr', [StockController::class, 'getSumOfSoldStock']);
Route::get('/get_current_stock_mtr', [StockController::class, 'getSumOfCurrentStock']);
Route::get('/get_current_stock', [StockController::class, 'getCurrentStock']);
Route::get('/get_total_sale_stock', [StockController::class, 'getTotalSale']);
Route::get('/get_stock_by_sort_grade', [StockController::class, 'getStockBySort']);
Route::get('/get_sum_Stock_sort', [StockController::class, 'getSumOfStockBySort']);
Route::get('/get_detail_sort_wise', [StockController::class, 'allDetailSortWise']);
Route::post('/add_bulk_stock', [StockController::class, 'addBulkStock']);

// Sale model api
Route::resource('/sale', SaleController::class);


// dashboard
// Route::get('/item_with_stock_purchase', [PurchaseController::class, 'getSortWiseDetails']);
// Route::get('/item_stock_detail',
// [PurchaseController::class, 'getSortWiseDetailSingle']);

// Route::get('/sortwise_stock', [StockController::class, 'getStocBySort']);




