<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeController;

Route::get('/sort_string/{string}', [ChangeController::class, 'sortString']);
Route:: get('/split_number/{number}', [ChangeController::class, 'splitNumber']);
Route:: get('/to_binary/{str}', [ChangeController::class, 'translateToBinary']);
Route::get('/calc_exp/{exp}', [ChangeController::class, 'calculateExpression']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
