@props(['file', 'width' => null, 'height' => null, 'title' => null, 'alt' => null])

<?php

use App\Models\File;

/* @var File $file */
/* @var int|null $width */
/* @var int|null $height */
/* @var string|null $title */
/* @var string|null $alt */
?>


<img {{ $attributes->merge(['class' => '']) }}
     src="{{ to()->web->file($file, $width, $height) }}"
     title="{{$title ?? $file->original_name}}"
     alt="{{$alt ?? $file->original_name}}"
     height="{{$height}}"
     width="{{$width}}"
/>
