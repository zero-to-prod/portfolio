<?php

use App\Helpers\Routes;
use App\Helpers\Views;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Http\Controllers\ConnectStoreRedirect;
use App\Http\Controllers\GithubCallback;
use App\Http\Controllers\GithubRedirect;
use App\Http\Controllers\ReadView;
use App\Http\Controllers\ResultsView;
use App\Http\Controllers\SearchRedirect;
use App\Http\Controllers\SubscribeView;
use App\Http\Controllers\WelcomeView;
use Illuminate\Support\Facades\Route;

Route::getAs(Routes::connect, Views::connect);
Route::getAs(Routes::file, FileServeResponse::class);
Route::getAs(Routes::read, ReadView::class);
Route::getAs(Routes::results, ResultsView::class);
Route::getAs(Routes::welcome, WelcomeView::class);
Route::getAs(Routes::subscribe, SubscribeView::class);
Route::postAs(Routes::connect_store, ConnectStoreRedirect::class);
Route::postAs(Routes::search, SearchRedirect::class);
Route::getAs(Routes::auth_github_index, GithubRedirect::class);
Route::getAs(Routes::auth_github_callback, GithubCallback::class);