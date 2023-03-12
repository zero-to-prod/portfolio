<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Helpers\Routes;
use App\Http\Controllers\Api\SubscribeResponse;
use Illuminate\Support\Facades\Route;

Route::postAs(Routes::subscribe, SubscribeResponse::class);
