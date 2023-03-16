<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum CacheKeys: string
{
    case newsletter = 'newsletter';
    case most_viewed = 'most_viewed';
    case related_posts = 'related_posts';
    case post_author = 'post_author';
    case post_author_post_count = 'post_author_post_count';
    case post_author_list = 'post_author_list';
}