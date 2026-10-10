<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimbanganController;

Route::get('/berat', [TimbanganController::class, 'berat']);

Route::post('/timbangan', [TimbanganController::class, 'store']);

Route::get('/timbangan', [TimbanganController::class, 'index']);