<?php

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

Route::middleware(['auth.basic'])->group(function () {


    Route::middleware(['admin'])->group(function () {
        //elérheti az admin, és a superAdmin
        Route::apiResource('/users', UserController::class);
    });

    Route::middleware(['superadmin'])->group(function () {

        //Csak a superadmin érheti el


    });
});
