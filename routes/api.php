<?php

use App\Http\Controllers\PotController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//felhasználó réteg (regisztráció nélkül)
//felhasználó réteg (regisztálva, bejelentkezve)

//Admin réteg


Route::middleware(['auth.basic'])->group(function () {


    Route::middleware(['admin'])->group(function () {
        //elérheti az admin, és a superAdmin
        Route::apiResource('/users', UserController::class);
    });

    Route::middleware(['superadmin'])->group(function () {

        //Csak a superadmin érheti el


    });
});



//SuperAdmin réteg

//Pot kiszerelés
Route::get('pots', [PotController::class, 'index']); //OK