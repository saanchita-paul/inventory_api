<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Purchase\PurchaseController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
/**
 * sanctum authentication middleware
 */
Route::group(['middleware' => ['auth:sanctum']], function () {
    /**
     * user logout
     */
    Route::post('/auth/logout',[AuthController::class,'logoutUser']);
    /**
     * get user
     */
    Route::get('/user', [AuthController::class,'getUser']);
    /**
     * product
     */
    Route::group(['prefix' => 'product'], function () {
        Route::post('/create', [ProductController::class, 'createProduct']);
        Route::get('/view/{id}', [ProductController::class, 'viewProduct']);
        Route::get('/list', [ProductController::class, 'productList']);
        Route::get('/categories',[ProductController::class, 'categoryList']);
    });
    /**
     * purchase
     */
    Route::group(['prefix' => 'purchase'], function () {
        Route::post('/create', [PurchaseController::class, 'createPurchase']);
        Route::get('/list', [PurchaseController::class, 'purchaseList']);
    });




});
/**
 * user register
 */
Route::post('/auth/register', [AuthController::class, 'createUser']);
/**
 * user login
 */
Route::post('/auth/login', [AuthController::class, 'loginUser']);



