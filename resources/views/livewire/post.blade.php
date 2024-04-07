<div class="card">
    <div class="card-header">
        <img src="{{ !str_contains($post->owner->image, 'users/') ? $post->owner->image : asset('storage/' . $post->owner->image) }}" class="rounded-full object-cover h-9 w-9 mr-3">
        <a href="/{{$post->owner->username}}" class="font-bold">{{$post->owner->username}}</a>
    </div>
    <div class="card-body">
        <div class="max-h-[35rem] overflow-hidden">
            <img src="{{asset('storage/' . $post->image)}}" alt="{{$post->description}}" class="h-auto w-full object-cover">
        </div>
        <div class="p-3 flex flex-row">
            <livewire:like :post="$post"/>
            <a href="/p/{{$post->slug}}/" class="grow">
                <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer"></i>
            </a>
        </div>
        <div class="p-3">
            <a href="/{{$post->owner->username}}" class="font-bold">{{$post->owner->username}}</a>
            {{$post->description}}
        </div>

        @if($post->comments()->count() > 0)
            <a href="/p/{{$post->slug}}" class="p-3 font-bold text-sm text-gray-500">
                {{ __('View all :count comments', ['count' => $post->comments()->count()]) }}
            </a>
        @endif
        <div class="p-3 text-gray-400 uppercase text-xs">
            {{$post->created_at->diffForHumans()}}
        </div>
    </div>

    <div class="card-footer">
        <form action="/p/{{$post->slug}}/comment" method="POST">
            @csrf
            <div class="flex flex-row">
                <textarea name="body" placeholder="{{__('Add a comment...')}}" autocomplete="off" class="grow border-none resize-none focus:ring-0 bg-none max-h-60 h-5 p-0 overflow-y-hidden placeholder-gray-400 dark:bg-transparent dark:text-gray-300"></textarea>
                <button type="submit" class="bg-white border-none text-blue-500 ml-5 dark:bg-transparent dark:text-indigo-100">{{__('POST')}}</button>
            </div>
        </form>
    </div>
</div>
