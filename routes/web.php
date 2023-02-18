<?php

use App\Http\Routes;
use App\Http\Views;
use Illuminate\Support\Facades\Route;

Route::getFromEnum(Routes::welcome, fn() => view(Views::welcome->value));
