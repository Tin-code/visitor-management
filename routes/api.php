<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ReceptionController;
use App\Http\Controllers\Api\VisitorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/auth/token',[LoginController::class,'store']);
    Route::get('/visitor',[VisitorController::class,'index']);
    Route::post('/visitor',[VisitorController::class,'store']);
    Route::get('/reception',[ReceptionController::class,'index']);
});

