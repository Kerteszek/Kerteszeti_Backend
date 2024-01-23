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
Route::middleware(['admin'])->group(function () {
    
});

Route::middleware(['auth.basic'])->group(function () {
    Route::apiResource('/users', UserController::class);
});


//SuperAdmin réteg

//Pot kiszerelés
Route::get('pots', [PotController::class, 'index']); //OK
