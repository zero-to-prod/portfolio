<?php

use App\Helpers\AuthRoutes;
use App\Helpers\Routes;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::getAs(AuthRoutes::register, [RegisteredUserController::class, 'create']);
Route::postAs(AuthRoutes::register_store, [RegisteredUserController::class, 'store']);
Route::get(Routes::auth_passwordReset_request->value, [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::postAs(AuthRoutes::passwordReset_store, [PasswordResetLinkController::class, 'store']);
Route::getAs(Routes::auth_passwordNew_create, [NewPasswordController::class, 'create']);
Route::post(Routes::auth_passwordNew_store->value, [NewPasswordController::class, 'store'])->name('password.store');
