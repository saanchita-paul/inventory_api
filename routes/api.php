<?php

use App\Http\Controllers\Api\AuthController;
use App\Models\Product;
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
});
/**
 * user register
 */
Route::post('/auth/register', [AuthController::class, 'createUser']);
/**
 * user login
 */
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::get('/products', function (Request $request) {
    return Product::query()
            ->where('product_name', 'like', "%{$request->get('search')}%")
       ->paginate($request->get('per_page'));

});
