<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Http\Controllers\Admin\Post\PostForm;
use App\Http\Controllers\Admin\Post\PostIndex;
use App\Http\Controllers\Admin\Post\PostStore;
use Illuminate\Support\Facades\Route;

/* Dashboard */
Route::getAs(to()->admin->dashboard, fn() => view('pages.admin.dashboard'));

/* Posts */
Route::getAs(to()->admin->post->index, PostIndex::class);
Route::getAs(to()->admin->post->create, PostForm::class);
Route::getAs(to()->admin->post->edit, PostForm::class);
Route::postAs(to()->admin->post->store, PostStore::class);