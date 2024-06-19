<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\JanreController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Api\BidController;
use App\Http\Controllers\Api\AuctionController;
use App\Http\Controllers\ComittentController;
use App\Http\Controllers\JewerlyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PictureJanreController;
use App\Http\Controllers\SectorController;

//PICTURES
Route::get('/pictures', [PictureController::class, 'index']);
Route::get('pictures/{id}', [PictureController::class, 'show']);
Route::post('pictures', [PictureController::class, 'store']);
Route::put('pictures/{id}', [PictureController::class, 'update']);
Route::delete('pictures/{id}', [PictureController::class, 'destroy']);

//USER
Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{user}', [UserController::class, 'update']);
Route::delete('users/{user}', [UserController::class, 'destroy']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//CREATOR
Route::get('/creators', [CreatorController::class, 'index']);
Route::post('/creators', [CreatorController::class, 'store']);
Route::get('/creators/{creator}', [CreatorController::class, 'show']);
Route::put('/creators/{creator}', [CreatorController::class, 'update']);
Route::delete('/creators/{creator}', [CreatorController::class, 'destroy']);

//JANRE
Route::get('/janres', [JanreController::class, 'index']);
Route::post('/janres', [JanreController::class, 'store']);
Route::get('/janres/{janre}', [JanreController::class, 'show']);
Route::put('/janres/{janre}', [JanreController::class, 'update']);
Route::delete('/janres/{janre}', [JanreController::class, 'destroy']); 

//BOOK
Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{book}', [BookController::class, 'show']);
Route::put('/books/{book}', [BookController::class, 'update']);
Route::delete('/books/{book}', [BookController::class, 'destroy']); 


//AUCTION
Route::get('/auctions', [AuctionController::class, 'index']);
Route::post('/auctions', [AuctionController::class, 'store']);
Route::get('/auctions/{auction}', [AuctionController::class, 'show']);
Route::put('/auctions/{auction}', [AuctionController::class, 'update']);
Route::delete('/auctions/{auction}', [AuctionController::class, 'destroy']); 

//BID
Route::get('/bids', [BidController::class, 'index']);
Route::post('/bids', [BidController::class, 'store']);
Route::get('/bids/{bid}', [BidController::class, 'show']);
Route::put('/bids/{bid}', [BidController::class, 'update']);
Route::delete('/bids/{bid}', [BidController::class, 'destroy']); 

//COMITTENT
Route::get('/comittents', [ComittentController::class, 'index']);
Route::post('/comittents', [ComittentController::class, 'store']);
Route::get('/comittents/{comittent}', [ComittentController::class, 'show']);
Route::put('/comittents/{comittent}', [ComittentController::class, 'update']);
Route::delete('/comittents/{comittent}', [ComittentController::class, 'destroy']); 

//JEWERLY
Route::get('/jewerlys', [JewerlyController::class, 'index']);
Route::post('/jewerlys', [JewerlyController::class, 'store']);
Route::get('/jewerlys/{jewerly}', [JewerlyController::class, 'show']);
Route::put('/jewerlys/{jewerly}', [JewerlyController::class, 'update']);
Route::delete('/jewerlys/{jewerly}', [JewerlyController::class, 'destroy']); 

//LOCATION
Route::get('/locations', [LocationController::class, 'index']);
Route::post('/locations', [LocationController::class, 'store']);
Route::get('/locations/{location}', [LocationController::class, 'show']);
Route::put('/locations/{location}', [LocationController::class, 'update']);
Route::delete('/locations/{location}', [LocationController::class, 'destroy']); 

//ORDER
Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/{order}', [OrderController::class, 'show']);
Route::put('/orders/{order}', [OrderController::class, 'update']);
Route::delete('/orders/{order}', [OrderController::class, 'destroy']); 

//ORDERDETAIL
Route::get('/order-details', [OrderDetailController::class, 'index']);
Route::post('/order-details', [OrderDetailController::class, 'store']);
Route::get('/order-details/{order-detail}', [OrderDetailController::class, 'show']);
Route::put('/order-details/{order-detail}', [OrderDetailController::class, 'update']);
Route::delete('/order-details/{order-detail}', [OrderDetailController::class, 'destroy']);

//PICTUREJANRE
Route::get('/picture-janres', [PictureJanreController::class, 'index']);
Route::post('/picture-janres', [PictureJanreController::class, 'store']);
Route::get('/picture-janres/{picture-janre}', [PictureJanreController::class, 'show']);
Route::put('/picture-janres/{picture-janre}', [PictureJanreController::class, 'update']);
Route::delete('/picture-janres/{picture-janre}', [PictureJanreController::class, 'destroy']);

//SECTOR
Route::get('/sectors', [SectorController::class, 'index']);
Route::post('/sectors', [SectorController::class, 'store']);
Route::get('/sectors/{sector}', [SectorController::class, 'show']);
Route::put('/sectors/{sector}', [SectorController::class, 'update']);
Route::delete('/sectors/{sector}', [SectorController::class, 'destroy']);