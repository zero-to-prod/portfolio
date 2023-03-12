<?php

use App\Helpers\Routes;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::getAs(Routes::auth_register_index, [RegisteredUserController::class, 'create']);
Route::postAs(Routes::auth_register_store, [RegisteredUserController::class, 'store']);
Route::get(Routes::auth_passwordReset_request->value, [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::postAs(Routes::auth_passwordReset_store, [PasswordResetLinkController::class, 'store']);
Route::getAs(Routes::auth_passwordNew_create, [NewPasswordController::class, 'create']);
Route::post(Routes::auth_passwordNew_store->value, [NewPasswordController::class, 'store'])->name('password.store');
