<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
class PostsList extends Component
{
    protected $listeners = ['toggleFollow' => 'resetPosts', 'scrollPosts' => 'getMorePosts'];
    public $postContainer = [];
    public $take = 2;
    public $skip = 0;


    public function resetPosts() {
        $this->postContainer = [];
        $this->take = 2;
        $this->skip = 0;
    }
    public function getPostsProperty()
    {
        $ids = auth()->user()->following()->wherePivot('confirmed', true)->get()->pluck('id');
        $this->postContainer = array_merge($this->postContainer , Post::whereIn('user_id', $ids)->latest()->skip($this->skip)->take($this->take)->get()->all());
        return $this->postContainer;
    }

    public function getMorePosts()
    {
        $this->skip += $this->take;
        if (count($this->postContainer) > 10) {
            array_shift($this->postContainer);
        }
    }
    public function render()
    {
        return view('livewire.posts-list');
    }
}
