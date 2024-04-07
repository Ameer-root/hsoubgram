<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class OthersLikedByModal extends ModalComponent
{
    public $postId;
    protected $post;
    public function getOtherUsersProperty()
    {
        $this->post = Post::find($this->postId);
        return $this->post->likes()->get();
    }

    public function render()
    {
        return view('livewire.others-liked-by-modal');
    }
}
