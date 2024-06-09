<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PictureController;

Route::get('pictures', [PictureController::class, 'index']);
Route::get('pictures/{id}', [PictureController::class, 'show']);
Route::post('pictures', [PictureController::class, 'store']);
Route::put('pictures/{id}', [PictureController::class, 'update']);
Route::delete('pictures/{id}', [PictureController::class, 'destroy']);
