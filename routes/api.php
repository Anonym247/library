<?php
declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HireController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
   Route::post('register', [AuthController::class, 'register']);
   Route::post('login', [AuthController::class, 'login']);
   Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
});

Route::group(['prefix' => 'hires', 'middleware' => 'auth:readers'], function () {
    Route::post('/', [HireController::class, 'store']);
    Route::put('/return', [HireController::class, 'giveBack']);
});

Route::group(['prefix' => 'books', 'middleware' => 'auth:readers'], function () {
    Route::get('/', [BookController::class, 'index']);
});
