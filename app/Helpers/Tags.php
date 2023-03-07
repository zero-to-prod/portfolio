<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum Tags: string
{
    case avatar = 'avatar';
    case featured = 'featured';
    case logo = 'logo';
    case post = 'post';
}