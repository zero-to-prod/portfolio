<?php

namespace App\Helpers;

use App\Http\Controllers\Admin\Author\AuthorFormView;
use App\Http\Controllers\Admin\Post\PostFormView;
use App\Http\Controllers\Admin\Post\PostPublishRedirect;
use App\Http\Controllers\Admin\Tag\TagFormView;

/**
 * @property $value
 * @property $name
 */
enum AdminRoutes: string
{

    /* Posts */
    case post_index = 'posts';
    case post_create = 'posts/create';
    case post_store = 'posts/store';
    case post_edit = 'posts/{' . PostFormView::post . '}/edit';
    case post_publish = 'posts/{' . PostPublishRedirect::id . '}/publish';
    case post_unPublish = 'posts/{' . PostFormView::post . '}/un-publish';

    /* Tags */
    case tag_index = 'tags';
    case tag_create = 'tags/create';
    case tag_edit = 'tags/{' . TagFormView::tag . '}/edit';
    case tag_store = 'tags/store';

    /* Authors */
    case author_index = 'authors';
    case author_create = 'authors/create';
    case author_edit = 'authors/{' . AuthorFormView::author . '}/edit';
    case author_store = 'authors/store';
}
