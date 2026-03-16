<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Generic\CreateController;
use App\Http\Controllers\Generic\DeleteController;
use App\Http\Controllers\Generic\ListController;
use App\Http\Controllers\Generic\UpdateController;


Route::middleware(['auth:sanctum'])->group(function () {
    return $request->user();
});
