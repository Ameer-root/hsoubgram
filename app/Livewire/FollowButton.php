<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    public $post;
    public $userId;
    public $followState;
    protected $user;

    protected $listeners =['toggleFollow' => 'mount'];

    public function mount()
    {
        $this->user = User::find($this->userId);
        $this->setFollowState();
    }
    public function toggle_follow()
    {
        $this->user = User::find($this->userId);
        auth()->user()->toggle_follow($this->user);
        $this->dispatch('toggleFollow');
        $this->setFollowState();
    }

    public function setFollowState()
    {
        if (auth()->user()->is_pending($this->user))
        {
            $this->followState = 'Pending';
        }
        elseif(auth()->user()->is_following($this->user))
        {
            $this->followState = 'Unfollow';
        }
        else
        {
            $this->followState = 'Follow';
        }

    }


    public function render()
    {
        return view('livewire.follow-button');
    }
}
