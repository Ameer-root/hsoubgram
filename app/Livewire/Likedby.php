<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Likedby extends Component
{
    public $postId;
    protected $post;
    protected $listeners = ['likeToggled' => 'getLikesProperty'];

    public function getLikesProperty()
    {
        $this->post = Post::find($this->postId);
        return $this->post->likes()->count();
    }

    public function getFirstusernameProperty()
    {
        return $this->post->likes()->first()->username;
    }


    public function render()
    {
        return view('livewire.likedby');
    }
}
