<?php

use App\Helpers\Routes;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::getAs(Routes::login, [AuthenticatedSessionController::class, 'create']);
Route::postAs(Routes::login_store, [AuthenticatedSessionController::class, 'store']);
