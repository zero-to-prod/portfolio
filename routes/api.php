<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Helpers\ApiRoutes;
use App\Http\Controllers\Api\SubscribeResponse;
use Illuminate\Support\Facades\Route;

Route::postAs(ApiRoutes::subscribe, SubscribeResponse::class);
