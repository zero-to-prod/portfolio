<?php

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileUploadResponse;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Password\ConfirmablePasswordController;
use App\Http\Controllers\Password\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Register\VerificationNotice;
use App\Http\Controllers\Register\VerificationSend;
use App\Http\Controllers\Register\VerificationVerify;
use Illuminate\Support\Facades\Route;

/* Files */
Route::postAs(Routes::auth_upload, FileUploadResponse::class);

/* Profile */
Route::getAs(Routes::profile_edit, [ProfileController::class, 'edit']);
Route::patchAs(Routes::profile_update, [ProfileController::class, 'update']);
Route::deleteAs(Routes::profile_destroy, [ProfileController::class, 'destroy']);

/* Auth */
Route::postAs(Routes::logout, Logout::class);
Route::getAs(Routes::password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postAs(Routes::password_store, [ConfirmablePasswordController::class, 'store']);
Route::putAs(Routes::auth_password_update, [PasswordController::class, 'update']);

Route::get(Routes::register_verification_notice->value, VerificationNotice::class)
    ->name('verification.notice');

Route::middleware('throttle:6,1')->group(function () {
    Route::get(Routes::register_verify->value, VerificationVerify::class)
        ->name('verification.verify');
    Route::post(Routes::register_verification_send->value, VerificationSend::class)
        ->name('verification.send');
});

Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

Route::put('password', [PasswordController::class, 'update'])->name('password.update');



