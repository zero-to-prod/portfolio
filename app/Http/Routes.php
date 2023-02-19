<?php

namespace App\Http;

enum Routes: string
{
    case cv = '/cv';
    case blog = '/blog';
    case connect = '/connect';
    case welcome = '/';
}
