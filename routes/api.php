<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RatingController;
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

//Public
Route::get("/coffee", [CoffeeController::class, "show"])->name("showAll");
Route::get("/coffee/{id}", [CoffeeController::class, "detail"])->name("showDetail");
Route::post("/registration", [LoginController::class, "regis"])->name("regis");


//Admin
Route::middleware(['auth.api', 'role.api:1'])->group(function () 
{
    Route::prefix('/admin')->group(function () {
        Route::get("/", function () {
            return response()->json([
                'message' => 'You are Admin'
            ]);
        });

        Route::post('/post/coffee', [CoffeeController::class, 'insert'])->name('insert.coffee');
        Route::post('/update/coffee/{id}', [CoffeeController::class, 'update'])->name('update.coffee');
        Route::delete('/delete/coffee/{id}', [CoffeeController::class, 'delete'])->name('delete.coffee');
    });
});


//Cashier
Route::middleware(['auth.api', 'role.api:2'])->group(function () 
{
    Route::post("/coffee/{id}/add", [CartController::class, "index"])->name("addCart");
    Route::get("/cart", [CartController::class, "show"])->name("showCart");
    Route::post("/transaction", [TransactionController::class, "index"])->name("addTransaction");

    Route::get("/cashier", function () {
        return response()->json([
            'message' => 'You are Cashier'
        ]);
    });
});


//User
Route::middleware(['auth.api', 'role.api:3'])->group(function () 
{
    Route::prefix('/user')->group(function () {
        Route::get("/", function () {
            return response()->json([
                'message' => 'You are User'
            ]);
        });

        Route::post('/post/rating', [RatingController::class, 'insert'])->name('insert.rating');

    });
});


//Auth
Route::middleware(['logout.api'])->group(function () {
    Route::post("/login", [LoginController::class, "index"])->name("login");
});

Route::middleware(['auth.api'])->group(function () {
    Route::post("/logout", [LoginController::class, "logout"])->name("logout");

    Route::get('/users', function () {
        return response()->json([
            'user'    => auth()->user(),
        ], 200);
    });
});
