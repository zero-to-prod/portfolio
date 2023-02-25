<?php

use App\Http\Controllers\ConnectStoreController;
use App\Http\Routes;
use App\Http\Views;
use Illuminate\Support\Facades\Route;

Route::getRoute(Routes::cv, Views::cv, cached: true);
Route::getRoute(Routes::connect, Views::connect, cached: true);
Route::postRoute(Routes::connect_store, ConnectStoreController::class);
Route::getRoute(Routes::welcome, Views::welcome, cached: true);
