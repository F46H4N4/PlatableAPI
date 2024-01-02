<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::post('/Donor',[DonorController::class,'store']);
    Route::get('/Donor/{id}',[DonorController::class,'show']);
    Route::post('/Recipient',[RecipientController::class,'store']);
    Route::get('/Recipient/{id}',[RecipientController::class,'show']);
    Route::post('/Foods',[FoodController::class,'store']);
    Route::get('/Foods/{id}',[FoodController::class,'show']);
    Route::get('/Donor/{donor_id}/donated-foods', [FoodController::class, 'getDonatedFoodsByDonor']);
    Route::put('/Foods/{id}',[FoodController::class,'update']);
    Route::delete('/Foods/{id}', [FoodController::class, 'destroy']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
