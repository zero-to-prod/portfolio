<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Helpers\Drivers;
use App\Helpers\Middlewares;
use App\Helpers\Routes;
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
Route::getAs(to()->tos, fn() => view('tos'));
Route::getAs(to()->privacy, fn()=> view('privacy'));
Route::getAs(to()->newsletter, NewsletterView::class);
Route::getAs(to()->subscribe, fn() => view('subscribe'));

Route::getAs(Routes::auth_github_callback, GithubCallback::class);
Route::getAs(Routes::auth_github_index, fn() => Socialite::driver(Drivers::github->value)->redirect());
Route::getAs(Routes::contact, Views::contact);
Route::getAs(Routes::file, FileServeResponse::class);
/* Login */
Route::getAs(Routes::loginIndex, fn() => view('login'));
Route::postAs(Routes::login, Login::class);
/* Register */
Route::getAs(Routes::registerIndex, fn() => view('register.index'));
Route::postAs(Routes::register_store, RegisterStoreRedirect::class);
Route::middlewareAs(Middlewares::signed)->group(function () {
    Route::getAs(Routes::register_notice, fn() => view('register.notice'));
    Route::getAs(Routes::register_verification, fn() => view('register.verification'));
});





Route::postAs(Routes::contact_store, ConnectStoreRedirect::class);
