@props(['file', 'width' => null, 'height' => null, 'title' => null, 'alt' => null])

<?php

use App\Helpers\Routes;
use App\Http\Controllers\Admin\File\FileServeResponse;
use App\Models\File;

/* @var File $file */
/* @var int|null $width */
/* @var int|null $height */
/* @var string|null $title */
/* @var string|null $alt */
?>


<img {{ $attributes->merge(['class' => '']) }}
     src="{{ route_as(Routes::file, [
    FileServeResponse::file => $file->name,
    FileServeResponse::width => $width,
    FileServeResponse::height => $height,
    ])}}"
     title="{{$title ?? $file->original_name}}"
     alt="{{$alt ?? $file->original_name}}"
     height="{{$height}}"
     width="{{$width}}"
/>
