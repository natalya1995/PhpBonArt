<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CreatorController;


//PICTURES
Route::get('/pictures', [PictureController::class, 'index']);
Route::get('pictures/{id}', [PictureController::class, 'show']);
Route::post('pictures', [PictureController::class, 'store']);
Route::put('pictures/{id}', [PictureController::class, 'update']);
Route::delete('pictures/{id}', [PictureController::class, 'destroy']);

//USER
Route::post('login', [UserController::class, 'login'])->name('login');;
Route::middleware('auth:api')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::post('users', [UserController::class, 'store']);
    Route::get('users/{user}', [UserController::class, 'show']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);
});

//CREATOR
Route::get('/creators', [CreatorController::class, 'index']);
Route::post('/creators', [CreatorController::class, 'store']);
Route::get('/creators/{creator}', [CreatorController::class, 'show']);
Route::put('/creators/{creator}', [CreatorController::class, 'update']);
Route::delete('/creators/{creator}', [CreatorController::class, 'destroy']);