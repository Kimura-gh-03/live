<?php

use App\Http\Controllers\TopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TopController::class, 'index'])->name('home');

require __DIR__.'/settings.php';
