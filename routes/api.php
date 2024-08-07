<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransactionController;
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

Route::middleware(['auth.api'])->group(function () {
    Route::get("/coffee", [CoffeeController::class, "show"])->name("showAll");
    Route::get("/coffee/{id}", [CoffeeController::class, "detail"])->name("showDetail");
    Route::post("/coffee/{id}/add", [CartController::class, "index"])->name("addCart");
    Route::get("/cart", [CartController::class, "show"])->name("showCart");
    Route::post("/transaction", [TransactionController::class, "index"])->name("addTransaction");
    Route::post("/logout", [LoginController::class, "logout"])->name("logout");

    Route::get('/user', function () {
        return response()->json([
            'user'    => auth()->user(),
        ], 200);
    });
});

Route::middleware(['logout.api'])->group(function () {
    Route::post("/login", [LoginController::class, "index"])->name("login");
});

Route::post("/registration", [LoginController::class, "regis"])->name("regis");
