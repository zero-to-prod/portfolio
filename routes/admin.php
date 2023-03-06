<?php

use App\Helpers\Middlewares;
use App\Helpers\Routes;
use App\Helpers\Views;
use App\Http\Controllers\Admin\File\FileUploadResponse;
use App\Http\Controllers\Admin\Post\PostFormRedirect;
use App\Http\Controllers\Admin\Post\PostFormView;
use App\Http\Controllers\Admin\Post\PostIndexView;
use App\Http\Controllers\Admin\Post\PostPublishRedirect;
use App\Http\Controllers\Admin\Post\PostUnPublishRedirect;
use App\Http\Controllers\Admin\Tag\TagFormRedirect;
use App\Http\Controllers\Admin\Tag\TagFormView;
use App\Http\Controllers\Admin\Tag\TagIndexView;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* Files */
Route::postAs(Routes::upload, FileUploadResponse::class);

/* Dashboard */
Route::getAs(Routes::dashboard, Views::dashboard)->middlewareAs(Middlewares::verified);

/* Posts */
Route::getAs(Routes::admin_post_index, PostIndexView::class);
Route::getAs(Routes::admin_post_create, PostFormView::class);
Route::getAs(Routes::admin_post_edit, PostFormView::class);
Route::postAs(Routes::admin_post_store, PostFormRedirect::class);
Route::postAs(Routes::admin_post_publish, PostPublishRedirect::class);
Route::postAs(Routes::admin_post_unPublish, PostUnPublishRedirect::class);

/* Tags */
Route::getAs(Routes::admin_tag_index, TagIndexView::class);
Route::getAs(Routes::admin_tag_create, TagFormView::class);
Route::getAs(Routes::admin_tag_edit, TagFormView::class);
Route::postAs(Routes::admin_tag_store, TagFormRedirect::class);

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
