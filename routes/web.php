<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimbanganController;

Route::get('/', [TimbanganController::class, 'halaman']);

Route::post('/timbangan/{id}/hapus', [TimbanganController::class, 'destroy'])
    ->name('timbangan.destroy');