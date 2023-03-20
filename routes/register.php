<?php

use App\Helpers\Routes;
use App\Http\Controllers\Password\NewPasswordController;
use App\Http\Controllers\Password\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::get(Routes::passwordReset_request->value, [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::postAs(Routes::passwordReset_store, [PasswordResetLinkController::class, 'store']);
Route::getAs(Routes::passwordNew_create, [NewPasswordController::class, 'create']);
Route::post(Routes::passwordNew_store->value, [NewPasswordController::class, 'store'])->name('password.store');
