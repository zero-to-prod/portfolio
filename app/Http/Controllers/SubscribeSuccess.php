<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SubscribeSuccess extends Controller
{

    public function __invoke(User $user): View|Factory|Application
    {

        return view('subscribe_success', ['user' => $user]);
    }
}
