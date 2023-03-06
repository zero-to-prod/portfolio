<?php

namespace App\Helpers;

/**
 * @property $value
 */
enum Environments: string
{
    case local = 'local';
    case production = 'production';
    case testing = 'testing';
}