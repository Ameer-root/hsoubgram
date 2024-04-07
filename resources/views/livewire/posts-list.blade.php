<div class="w-[30rem] mx-auto lg:w-[95rem]">
        @forelse($this->posts as $post)
            <livewire:post :post="$post" :wire:key="'post_'.$post->id"/>
        @empty
            <div class="max-w-2xl gap-8 mx-auto dark:text-gray-100">
                {{__('Start Following Your Friends and Enjoy.')}}
            </div>

        @endforelse
</div>

@script
<script>
    window.onscroll = function(ev) {
        if ((window.innerHeight + Math.round(window.scrollY)) >= document.body.offsetHeight) {
            $wire.dispatch('scrollPosts');
        }
    };
</script>
@endscript
