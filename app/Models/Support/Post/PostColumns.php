<?php

namespace App\Models\Support\Post;

trait PostColumns
{
    public const file_id = 'file_id';
    public const alt_file_id = 'alt_file_id';
    public const animation_file_id = 'animation_file_id';
    public const post_type_id = 'post_type_id';
    public const title = 'title';
    public const subtitle = 'subtitle';
    public const public_content = 'public_content';
    public const cta = 'cta';
    public const exclusive_content = 'exclusive_content';
    public const views = 'views';
    public const likes = 'likes';
    public const dislikes = 'dislikes';
    public const published_public_content = 'published_public_content';
    public const published_cta = 'published_cta';
    public const published_exclusive_content = 'published_exclusive_content';
    public const public_word_count = 'public_word_count';
    public const public_reading_time = 'public_reading_time';
    public const exclusive_word_count = 'exclusive_word_count';
    public const exclusive_reading_time = 'exclusive_reading_time';

    public const original_publish_date = 'original_publish_date';
    public const published_at = 'published_at';
    public const premiere_at = 'premiere_at';
}
