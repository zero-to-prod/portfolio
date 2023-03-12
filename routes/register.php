<?php

use App\Helpers\AuthRoutes;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::getAs(AuthRoutes::register, [RegisteredUserController::class, 'create']);
Route::postAs(AuthRoutes::register_store, [RegisteredUserController::class, 'store']);
Route::get(AuthRoutes::passwordReset_request->value, [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::postAs(AuthRoutes::passwordReset_store, [PasswordResetLinkController::class, 'store']);
Route::getAs(AuthRoutes::passwordNew_create, [NewPasswordController::class, 'create']);
Route::post(AuthRoutes::passwordNew_store->value, [NewPasswordController::class, 'store'])->name('password.store');
