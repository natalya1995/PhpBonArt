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
use App\Http\Controllers\BidController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\ComittentController;
use App\Http\Controllers\JewerlyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PictureJanreController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\NotificationController;



Route::options('/{any}', function () {
    return response()->json([], 200);
})->where('any', '.*');
//Route::post('/send-email', [EmailController::class, 'sendEmail']);
Route::post('/notifications', [NotificationController::class, 'store']);

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
Route::post('/items/create', [ItemController::class, 'store']);
Route::get('/auctions', [AuctionController::class, 'index']);
Route::post('/auctions', [AuctionController::class, 'store']);
Route::get('/auctions/{auction}', [AuctionController::class, 'show']);
Route::put('/auctions/{auction}', [AuctionController::class, 'update']);
Route::delete('/auctions/{auction}', [AuctionController::class, 'destroy']);
Route::post('/auctions/{auctionId}/complete', [AuctionController::class, 'completeAuction'])->name('auctions.complete');



//BID
Route::get('/bids', [BidController::class, 'index']);
Route::post('/bids', [BidController::class, 'store']);
Route::get('/bids/{bid}', [BidController::class, 'show']);
Route::put('/bids/{bid}', [BidController::class, 'update']);
Route::delete('/bids/{bid}', [BidController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/user-bids', [BidController::class, 'getUserBids']);

//COMITTENT
Route::get('/comittents', [ComittentController::class, 'index']);
Route::post('/comittents', [ComittentController::class, 'store']);
Route::get('/comittents/{comittent}', [ComittentController::class, 'show']);
Route::put('/comittents/{comittent}', [ComittentController::class, 'update']);
Route::delete('/comittents/{comittent}', [ComittentController::class, 'destroy']); 

//JEWERLY
Route::get('/jewerlies', [JewerlyController::class, 'index']);
Route::post('/jewerlies', [JewerlyController::class, 'store']);
Route::get('/jewerlies/{jewerly}', [JewerlyController::class, 'show']);
Route::put('/jewerlies/{jewerly}', [JewerlyController::class, 'update']);
Route::delete('/jewerlies/{jewerly}', [JewerlyController::class, 'destroy']); 

//LOCATION
Route::get('/locations', [LocationController::class, 'index']);
Route::post('/locations', [LocationController::class, 'store']);
Route::get('/locations/{location}', [LocationController::class, 'show']);
Route::put('/locations/{location}', [LocationController::class, 'update']);
Route::delete('/locations/{location}', [LocationController::class, 'destroy']); 


// Orders
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::get('/orders/{id}', [OrderController::class, 'show'])->middleware('auth:sanctum');
// Route::put('/orders/{id}', [OrderController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->middleware('auth:sanctum');
Route::put('/orders/pay', [OrderController::class, 'payOrder'])->middleware('auth:sanctum');


// Cart
Route::post('/cart/add', [OrderController::class, 'addToCart'])->middleware('auth:sanctum');
Route::get('/cart', [OrderController::class, 'getCart'])->middleware('auth:sanctum');
Route::delete('/cart/{id}', [OrderController::class, 'removeFromCart'])->middleware('auth:sanctum');

// Checkout
Route::post('/checkout', [OrderController::class, 'checkout'])->middleware('auth:sanctum');


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