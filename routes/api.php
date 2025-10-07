<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);

Route::get('/test', function () {
    return response()->json([
        'message' => 'API de CRUD de usuarios funcionando!',
        'status' => 'success'
    ]);
});