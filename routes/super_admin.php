<?php
/** @noinspection StaticClosureCanBeUsedInspection */

use App\Http\Controllers\Admin\Author\AuthorForm;
use App\Http\Controllers\Admin\Author\AuthorIndex;
use App\Http\Controllers\Admin\Author\AuthorStore;
use App\Http\Controllers\Admin\Post\PostPublish;
use App\Http\Controllers\Admin\Post\PostUnPublish;
use App\Http\Controllers\Admin\Tag\TagForm;
use App\Http\Controllers\Admin\Tag\TagFormStore;
use App\Http\Controllers\Admin\Tag\TagIndex;
use Illuminate\Support\Facades\Route;

/* Post */
Route::postAs(to()->admin->post->publish, PostPublish::class);
Route::postAs(to()->admin->post->unPublish, PostUnPublish::class);

/* Tag */
Route::getAs(to()->admin->tag->index, TagIndex::class);
Route::getAs(to()->admin->tag->create, TagForm::class);
Route::getAs(to()->admin->tag->edit, TagForm::class);
Route::postAs(to()->admin->tag->store, TagFormStore::class);

/* Author */
Route::getAs(to()->admin->author->index, AuthorIndex::class);
Route::getAs(to()->admin->author->create, AuthorForm::class);
Route::getAs(to()->admin->author->edit, AuthorForm::class);
Route::postAs(to()->admin->author->store, AuthorStore::class);
