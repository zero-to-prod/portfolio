<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Routes;

Route::getAs(Routes::register, [RegisteredUserController::class, 'create']);
Route::postAs(Routes::register_store, [RegisteredUserController::class, 'store']);
Route::get(Routes::passwordReset_request->value, [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::postAs(Routes::passwordReset_store, [PasswordResetLinkController::class, 'store']);
Route::getAs(Routes::passwordNew_create, [NewPasswordController::class, 'create']);
Route::post(Routes::passwordNew_store->value, [NewPasswordController::class, 'store'])->name('password.store');
