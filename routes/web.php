<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\VisitorController;
use App\Models\Reception;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/visiteur', function () {
    return view('visitors');
})->name('visiteurs');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('agents', [indexController::class,'home'])->name('mtn.agents');
    Route::post('agents', [indexController::class,'create'])->name('mtn.agents');
    Route::get('visiteurs',[VisitorController::class,'index'])->name('mtn.visitors');
    Route::post('visiteurs',[VisitorController::class,'store'])->name('mtn.visitors');
    Route::get('reception',[ReceptionController::class,'index'])->name('mtn.reception');
    Route::get('graph_update', [indexController::class,'graphUpdate']);
    Route::get('/edit/{id}', [VisitorController::class, 'edit']);
    Route::post('/updated', [VisitorController::class, 'update']);
    Route::get('/delete/{id}', [VisitorController::class, 'destroy']);
});
