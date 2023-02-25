<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Routes;

Route::getFromEnum(Routes::register, [RegisteredUserController::class, 'create']);
Route::postFromEnum(Routes::register_store, [RegisteredUserController::class, 'store']);
Route::getFromEnum(Routes::login, [AuthenticatedSessionController::class, 'create']);
Route::postFromEnum(Routes::login_store, [AuthenticatedSessionController::class, 'store']);
Route::get(Routes::passwordReset_request->value, [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::postFromEnum(Routes::passwordReset_store, [PasswordResetLinkController::class, 'store']);
Route::getFromEnum(Routes::passwordNew_create, [NewPasswordController::class, 'create']);
Route::post(Routes::passwordNew_store->value, [NewPasswordController::class, 'store'])->name('password.store');

