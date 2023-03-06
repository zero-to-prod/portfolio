<?php

use App\Helpers\Middlewares;
use App\Helpers\Routes;
use App\Helpers\Views;
use App\Http\Controllers\AdminPostFormController;
use App\Http\Controllers\AdminPostIndexController;
use App\Http\Controllers\AdminTagFormController;
use App\Http\Controllers\AdminTagIndexController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PostFormController;
use App\Http\Controllers\PostPublishController;
use App\Http\Controllers\PostUnPublishController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagFormController;
use Illuminate\Support\Facades\Route;

/* Files */
Route::postAs(Routes::upload, FileUploadController::class);

/* Dashboard */
Route::getAs(Routes::dashboard, Views::dashboard)->middlewareAs(Middlewares::verified);

/* Posts */
Route::getAs(Routes::admin_post_index, AdminPostIndexController::class);
Route::getAs(Routes::admin_post_create, AdminPostFormController::class);
Route::getAs(Routes::admin_post_edit, AdminPostFormController::class);
Route::postAs(Routes::admin_post_store, PostFormController::class);
Route::postAs(Routes::admin_post_publish, PostPublishController::class);
Route::postAs(Routes::admin_post_unPublish, PostUnPublishController::class);

/* Tags */
Route::getAs(Routes::admin_tag_index, AdminTagIndexController::class);
Route::getAs(Routes::admin_tag_create, AdminTagFormController::class);
Route::getAs(Routes::admin_tag_edit, AdminTagFormController::class);
Route::postAs(Routes::admin_tag_store, TagFormController::class);

/* Profile */
Route::getAs(Routes::profile_edit, [ProfileController::class, 'edit']);
Route::patchAs(Routes::profile_update, [ProfileController::class, 'update']);
Route::deleteAs(Routes::profile_destroy, [ProfileController::class, 'destroy']);

/* Email */
Route::getAs(Routes::email_verificationNotice, EmailVerificationPromptController::class);
Route::getAs(Routes::email_verify, VerifyEmailController::class)
    ->middlewareAs([Middlewares::signed, Middlewares::throttle->value . ':6,1']);
Route::postAs(Routes::email_verificationNotification, [EmailVerificationNotificationController::class, 'store'])
    ->middlewareAs(Middlewares::throttle->value . ':6,1');

/* Auth */
Route::getAs(Routes::password_confirm, [ConfirmablePasswordController::class, 'show']);
Route::postAs(Routes::password_store, [ConfirmablePasswordController::class, 'store']);
Route::postAs(Routes::logout, [AuthenticatedSessionController::class, 'destroy']);
Route::putAs(Routes::password_update, [PasswordController::class, 'update']);
