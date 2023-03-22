<?php

namespace App\Http\Livewire;

use App\Helpers\SessionKeys;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Session;

class Reactions extends Component
{
    public Post $post;
    public string $url;

    public function mount(): void
    {
        $this->url = request()?->getUri();
    }

    public function like(): void
    {
        if (auth()->check()) {
            $this->post->like();

            return;
        }

        $this->redirectToLogin();

    }

    public function dislike(): void
    {
        if (auth()->check()) {
            $this->post->dislike();

            return;
        }

        $this->redirectToLogin();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.reactions');
    }

    protected function redirectToLogin(): void
    {
        Session::put(SessionKeys::post->value, $this->url);

        $this->redirect(to()->login->index());
    }
}
