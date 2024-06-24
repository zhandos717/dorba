<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SetJsonAcceptHeader;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1')->middleware([SetJsonAcceptHeader::class])->group(function () {
    Route::get('products/search', [ProductController::class, 'search']);
});