<?php

use App\Helpers\Routes;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::getAs(Routes::guest_login_index, [AuthenticatedSessionController::class, 'create']);
Route::postAs(Routes::guest_login_store, [AuthenticatedSessionController::class, 'store']);
