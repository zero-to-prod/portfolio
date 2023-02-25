<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Routes;
use Illuminate\Support\Facades\Route;

Route::getRoute(Routes::login, [AuthenticatedSessionController::class, 'create']);
Route::postRoute(Routes::login_store, [AuthenticatedSessionController::class, 'store']);
