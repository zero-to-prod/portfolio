<?php

use App\Http\Controllers\ConnectStoreController;
use App\Http\Routes;
use App\Http\Views;
use Illuminate\Support\Facades\Route;

Route::getAs(Routes::cv, Views::cv, cached: true);
Route::getAs(Routes::connect, Views::connect, cached: true);
Route::postAs(Routes::connect_store, ConnectStoreController::class);
Route::getAs(Routes::welcome, Views::welcome, cached: true);
