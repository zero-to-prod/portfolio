<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Reactions extends Component
{
    public Post $post;

    public function like(): void
    {
        $this->post->like();
    }

    public function dislike(): void
    {
        $this->post->dislike();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.reactions');
    }
}
