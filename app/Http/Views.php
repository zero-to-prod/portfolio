<?php

namespace App\Http;

enum Views: string
{
    case welcome = 'welcome';
    case connect = 'connect';
    case blog = 'blog';
}
