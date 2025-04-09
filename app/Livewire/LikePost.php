<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likesCount;

    public function mount($post)
    {
        $this->post = $post;
        $this->checkIfLiked();
        $this->updateLikesCount();
    }

    public function like()
    {
        if (Auth::check()) {
            if ($this->isLiked) {
                $this->post->likes()->where('user_id', Auth::id())->delete();
                $this->isLiked = false;
            } else {
                $this->post->likes()->create(['user_id' => Auth::id()]);
                $this->isLiked = true;
            }
            $this->updateLikesCount();
        } else {
            $this->dispatch('user-not-logged-in');
        }
    }

    private function checkIfLiked()
    {
        if (Auth::check()) {
            $this->isLiked = $this->post->likes()->where('user_id', Auth::id())->exists();
        } else {
            $this->isLiked = false;
        }
    }

    private function updateLikesCount()
    {
        $this->likesCount = $this->post->likes()->count();
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}