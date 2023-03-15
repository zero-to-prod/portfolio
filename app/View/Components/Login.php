<?php

namespace App\View\Components;

use App\Helpers\Views;
use Illuminate\View\Component;
use Illuminate\View\View;

class Login extends Component
{

    public function render(): View
    {
        return view_as(Views::layouts_login);
    }
}
