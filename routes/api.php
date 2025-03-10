<?php

use App\Http\Controllers\Api\RateController;
use App\Http\Controllers\Api\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthApi;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(["middleware" => [AuthApi::class]], function () {

    Route::get('/schools', [SchoolController::class, 'index']);
    Route::get('/schools/{bin}', [SchoolController::class, 'show']);

    Route::get("/rates/{bin}", [RateController::class, 'showRatesBySchoolBin']);
});
