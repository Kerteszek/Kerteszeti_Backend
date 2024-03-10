<?php

use App\Http\Controllers\PictureController;
use App\Http\Controllers\PlantController;
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
        //Termék Update és Patch
        Route::patch('products/{product_id}', [ProductController::class, 'update']);
        Route::post('products', [ProductController::class, 'store']);

        Route::patch('plants/{scientific_name}', [PlantController::class, 'update']);
        Route::post('plants', [PlantController::class, 'store']);
    });

    Route::middleware(['superadmin'])->group(function () {
        //Csak a superadmin érheti el
        //Route::delete('/products/{product_id}', [PlantController::class, 'destroy']);
        Route::get('users', [UserController::class, 'index']);
    });
});

//felhasználó réteg (regisztráció nélkül)
Route::get('products', [ProductController::class, 'index']);

//Termék összes frontendremenő adata
Route::get('product_frontend', [ProductController::class, 'frontendTermek']);
//frontendTermekKeppel
Route::get('product_w_pictures', [ProductController::class, 'frontendTermekKeppel']);


//Képek elérési útja
Route::get('pictures', [PictureController::class, 'index']);
