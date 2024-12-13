<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('posts', PostController::class);

Route::apiResource('contacts', ContactController::class);

Route::apiResource('customers', CustomerController::class);

Route::apiResource('addresses', AddressController::class);

// Route::get('/', function () {
//     return 'API';
// });
