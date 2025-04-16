<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/usuario-logado', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->apiResource('people', PersonController::class);
