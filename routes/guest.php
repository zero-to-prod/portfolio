<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get(r()->guest->login(), [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post(r()->guest->loginStore(), [AuthenticatedSessionController::class, 'store']);
