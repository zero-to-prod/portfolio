<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum CacheKeys: string
{
    case newsletter = 'newsletter';
    case related_posts = 'related_posts';
    case post_author = 'post_author';
    case post_author_post_count = 'post_author_post_count';
    case post_author_list = 'post_author_list';
    case most_viewed_tags = 'most_viewed_tags';
    case welcome = 'welcome';
}