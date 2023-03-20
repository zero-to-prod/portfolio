<?php

use App\Helpers\Routes;
use App\Http\Controllers\Password\NewPasswordController;
use App\Http\Controllers\Password\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::get(Routes::auth_passwordReset_request->value, [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::postAs(Routes::auth_passwordReset_store, [PasswordResetLinkController::class, 'store']);
Route::getAs(Routes::auth_passwordNew_create, [NewPasswordController::class, 'create']);
Route::post(Routes::auth_passwordNew_store->value, [NewPasswordController::class, 'store'])->name('password.store');
