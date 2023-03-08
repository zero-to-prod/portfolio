@props(['post'])

<?php

use App\Models\Post;

/* @var Post $post */
?>

<p class="text-sm text-gray-600">
    <x-views :post="$post"/>
    <span before="•"
          class="before:content-[attr(before)]">
                            <x-published-date-diff :post="$post"/>
                        </span>
</p>