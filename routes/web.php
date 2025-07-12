<?php

use App\Http\Controllers\BitrixController;
use App\Http\Controllers\BitrixFormController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', PageController::class);

Route::post('/send-bitrix', [BitrixFormController::class, 'send']);
Route::post('/submit-bitrix-form', [BitrixController::class, 'submitForm']);
Route::post('/deals', [DealController::class, 'store']);
