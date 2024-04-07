<?php

namespace App\Livewire;



use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class FollowingModal extends ModalComponent
{
    public $userId;
    protected $user;

    public function getFollowingListProperty()
    {
        $this->user = User::find($this->userId);
        return $this->user->following()->wherePivot('confirmed', true)->get();
    }



    public function unfollow($userId)
    {
        // التأكد من ان المستخدم صاحب الملف الشخصي يعادل المستخدم الذي يتواجد حالياً
        if ($this->userId === auth()->id())
        {
        $following_user = User::find($userId);
        $this->user = User::find($this->userId);
        $this->user->unfollow($following_user);
        $this->dispatch('unfollowUser');
        }
    }
    public function render()
    {
        return view('livewire.following-modal');
    }
}
