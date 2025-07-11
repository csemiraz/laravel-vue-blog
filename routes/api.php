<?php

use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

//Category Route
Route::get('/categories/view', [CategoryController::class, 'index'])->middleware('auth:sanctum');
Route::post('/categories/store', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::get('/categories/show/{id}', [CategoryController::class, 'show'])->middleware('auth:sanctum');
Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');
