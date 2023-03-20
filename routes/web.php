<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Helpers\Drivers;
use App\Helpers\Middlewares;
use App\Helpers\Views;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\Auth\GithubCallback;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\ConnectStoreRedirect;
use App\Http\Controllers\NewsletterView;
use App\Http\Controllers\ReadView;
use App\Http\Controllers\Register\StoreRedirect as RegisterStoreRedirect;
use App\Http\Controllers\ResultsView;
use App\Http\Controllers\SearchRedirect;
use App\Http\Controllers\WelcomeView;
use Illuminate\Support\Facades\Route;

Route::getAs(to()->welcome, WelcomeView::class);
Route::getAs(to()->read, ReadView::class);
Route::postAs(to()->search, SearchRedirect::class);
Route::getAs(to()->results, ResultsView::class);

/* 2592000 = 30 days */
Route::middleware('cache.headers:public;max_age=2592000;etag')->group(function () {
    Route::getAs(to()->file, FileServeResponse::class);
});

/* Subscription */
Route::getAs(to()->newsletter, NewsletterView::class);
Route::getAs(to()->subscribe, fn() => view('subscribe'));

/* Login */
Route::getAs(to()->login->index, fn() => view('login'));
Route::postAs(to()->login->store, Login::class);
Route::getAs(to()->auth->github->callback, GithubCallback::class);
Route::getAs(to()->auth->github->index, fn() => Socialite::driver(Drivers::github->value)->redirect());

/* Register */
Route::getAs(to()->register->index, fn() => view('register.index'));
Route::postAs(to()->register->store, RegisterStoreRedirect::class);
Route::middlewareAs(Middlewares::signed)->group(function () {
    Route::getAs(to()->register->notice, fn() => view('register.notice'));
    Route::getAs(to()->register->verification, fn() => view('register.verification'));
});

/* Contact */
Route::getAs(to()->contact, Views::contact);
Route::postAs(to()->contact_store, ConnectStoreRedirect::class);

/* Legal */
Route::getAs(to()->tos, fn() => view('tos'));
Route::getAs(to()->privacy, fn() => view('privacy'));