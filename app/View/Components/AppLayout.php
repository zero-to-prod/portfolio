<?php

namespace App\View\Components;

use App\Http\Views;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view_as(Views::layouts_app);
    }
}
