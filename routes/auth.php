<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Routes;

Route::getFromEnum(Routes::dashboard, fn() => view('dashboard'))->middleware(['verified']);
Route::getFromEnum(Routes::profile_edit, [ProfileController::class, 'edit']);
Route::patchFromEnum(Routes::profile_update, [ProfileController::class, 'update']);
Route::deleteFromEnum(Routes::profile_destroy, [ProfileController::class, 'destroy']);
Route::getFromEnum(Routes::verification_notice, EmailVerificationPromptController::class);
Route::getFromEnum(Routes::verification_verify, VerifyEmailController::class)->middleware(['signed', 'throttle:6,1']);
Route::postFromEnum(Routes::verification_send, [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1');
Route::getFromEnum(Routes::password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
Route::put('password', [PasswordController::class, 'update'])->name('password.update');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
