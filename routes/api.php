<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\FilterPostController;
use App\Http\Controllers\API\FrontPostController;
use App\Http\Controllers\API\FrontCategorycontroller;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

/* Auth Route */
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

//Category Route
Route::get('/categories/view', [CategoryController::class, 'index'])->middleware('auth:sanctum');
Route::post('/categories/store', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::get('/categories/show/{id}', [CategoryController::class, 'show'])->middleware('auth:sanctum');
Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/categories/delete/{id}', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');

/* Dashboard Post Route */
Route::get('/posts/view', [PostController::class, 'index'])->middleware('auth:sanctum');
Route::post('/posts/store', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::get('/posts/show/{id}', [PostController::class, 'show'])->middleware('auth:sanctum');
Route::put('/posts/update/{id}', [PostController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/posts/delete/{id}', [PostController::class, 'destroy'])->middleware('auth:sanctum');

/* FrontEnd Route */
Route::get('/posts/all', [FrontPostController::class, 'index']);
Route::get('/posts/detail/{slug}', [FrontPostController::class, 'singlePost']);
Route::get('/posts/related/{post:slug}', [FrontPostController::class, 'relatedPost']);
Route::get('/posts/blog-post', [FrontPostController::class, 'blogPost']);
Route::get('/categories/all', [FrontCategorycontroller::class, 'index']);
Route::get('/posts-by-category/{category}', [FilterPostController::class, 'postByCategory']);
Route::get('/search', [FilterPostController::class, 'search']);
