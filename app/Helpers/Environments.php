<?php

namespace App\Helpers;

/**
 * @property $value
 * @property $name
 */
enum Environments: string
{
    case local = 'local';
    case production = 'production';
    case testing = 'testing';
}