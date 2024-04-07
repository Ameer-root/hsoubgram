<div>
    <a wire:click="toggle_like">
        @if($post->liked(auth()->user()))
            <i class="bx bxs-heart text-3xl text-red-600 hover:text-red-500 cursor-pointer mr-3"></i>
        @else
            <i class="bx bx-heart text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
        @endif
    </a>
</div>
