@props(['file', 'width' => null, 'height' => null, 'title' => null, 'alt' => null])

<?php

use App\Models\File;

/* @var File $file */
/* @var int|null $width */
/* @var int|null $height */
/* @var string|null $title */
/* @var string|null $alt */
?>

<picture>
     <source media="(max-width: 490px)" srcset="{{ to()->file($file, 480) }}" />
     <img {{ $attributes->merge(['class' => '']) }}
          srcset="{{ to()->file($file, 100) }}, {{ to()->file($file, $width, $height) }} 2x"
          src="{{ to()->file($file, $width, $height) }}"
          title="{{$title ?? $file->original_name}}"
          alt="{{$alt ?? $file->original_name}}"
          height="{{$height ?? 0}}"
          width="{{$width ?? 0}}"
          itemprop="image"
     />
</picture>
