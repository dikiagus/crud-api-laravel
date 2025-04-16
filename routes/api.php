<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataController;

Route::post('/login', [AuthController::class, 'login']); 

Route::post('/users', [UserController::class, 'store']);
Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);
Route::middleware('auth:sanctum')->get('/users/{id}', [UserController::class, 'show']);
Route::middleware('auth:sanctum')->put('/users/{id}', [UserController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/users/{id}', [UserController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/search/name/{name}', [DataController::class, 'searchByName']);
Route::middleware('auth:sanctum')->get('/search/nim/{nim}', [DataController::class, 'searchByNim']);
Route::middleware('auth:sanctum')->get('/search/ymd/{ymd}', [DataController::class, 'searchByYmd']);
