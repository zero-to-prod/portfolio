<?php

namespace App\View\Components;

use App\Helpers\Views;
use Illuminate\View\Component;
use Illuminate\View\View;

class Main extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view_as(Views::layouts_main);
    }
}
