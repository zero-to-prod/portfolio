<?php

use App\Models\User;

/* @var User $user */
?>

<p>{{$user->name}}</p>
<p>{{$user->email}}</p>
<p>{{$user->github_id !== null ? 'GitHub' : 'Email'}}</p>