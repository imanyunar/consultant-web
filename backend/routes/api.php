<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Generic\CreateController;
use App\Http\Controllers\Generic\DeleteController;
use App\Http\Controllers\Generic\ListController;
use App\Http\Controllers\Generic\UpdateController;
use App\Http\Controllers\Generic\ShowController;


Route::post('/login', [CreateController::class, 'login']);
Route::post('/register', [CreateController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [DeleteController::class, 'logout']);
    Route::get('/{model}/{id}/{action}', [ListController::class, 'action']);
    Route::get('/{model}/{id}', [ShowController::class, 'show']);
    Route::get('/{model}', [ListController::class, 'index']);
    Route::post('/{model}', [CreateController::class, 'store']);
    Route::delete('/{model}/{id}', [DeleteController::class, 'destroy']);
    Route::patch('/{model}/{id}', [UpdateController::class, 'update']);

});
