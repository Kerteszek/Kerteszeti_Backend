<?php

use App\Http\Controllers\PictureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


//felhasználó réteg (regisztálva, bejelentkezve)
Route::middleware(['auth.basic'])->group(function () {


    Route::middleware(['admin'])->group(function () {
        //elérheti az admin, és a superAdmin
        Route::apiResource('/users', UserController::class);
        //Route::post('products', [ProductController::class, 'store']);
    });

    Route::middleware(['superadmin'])->group(function () {
        //Csak a superadmin érheti el


    });
});

//felhasználó réteg (regisztráció nélkül)
Route::get('products', [ProductController::class, 'index']);

//Termék összes frontendremenő adata
Route::get('product_frontend', [ProductController::class, 'frontendTermek']);

//Képek elérési útja
Route::get('pictures', [PictureController::class, 'index']);
