<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SubscribeAddPassword extends Controller
{

    public function __invoke(User $user): View|Factory|Application
    {

        return view('pages.subscribe.add_password', ['user' => $user]);
    }
}
