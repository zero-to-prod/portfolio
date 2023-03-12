<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get(to()->guest->login(), [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post(to()->guest->loginStore(), [AuthenticatedSessionController::class, 'store']);
