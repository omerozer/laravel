<?php

use App\Http\Controllers\KisiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KisiController::class, 'index'])->name('home');
Route::post('/kaydet', [KisiController::class, 'store'])->name('kisi.store');
