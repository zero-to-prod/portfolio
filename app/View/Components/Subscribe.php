<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Subscribe extends Component
{

    public function render(): View
    {
        return view('layouts.subscribe');
    }
}
