<x-app-layout>
    <div class="h-screen md:flex md:flex-row">
{{--        Left Side--}}
        <div class="h-full md:w-7/12 bg-black flex items-center">
            <img src="{{asset('storage/'.$post->image)}}" alt="{{$post->description}}" class="max-h-screen object-cover mx-auto">
        </div>
{{--        Right Side--}}
        <div class="flex w-full flex-col bg-white md:w-5/12 dark:bg-neutral-900 dark:text-gray-100">
{{--            Top--}}
            <div class="border-b-2 dark:border-b-gray-500">
                <div class="flex items-center p-5">
                    <img src="{{ !str_contains($post->owner->image, 'users/') ? $post->owner->image : asset('storage/' . $post->owner->image) }}" alt="{{$post->owner->username}}" class="mr-5 object-cover h-10 w-10 rounded-full">
                    <div class="grow">
                    <a href="/{{$post->owner->username}}" class="font-bold">{{$post->owner->username}}</a>
                    </div>
{{--                    @if($post->owner->id === auth()->id())--}}
                    @can('update', $post)
{{--                        <a href="/p/{{$post->slug}}/edit">--}}
{{--                            <i class='bx bx-message-square-edit text-xl'></i>--}}
{{--                        </a>--}}
                    <button onclick="Livewire.dispatch('openModal', { component: 'edit-post-modal', arguments: { post: {{$post->id}} }})">
                        <i class='bx bx-message-square-edit text-xl'></i>
                    </button>
                        <form action="/p/{{$post->slug}}/delete" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this post?')">
                                <i class='bx bx-message-square-x text-xl ml-2 text-red-600'></i>
                            </button>
                        </form>
                    @endcan
                    @cannot('update', $post)
                        <livewire:follow-button :post="$post" :userId="$post->owner->id"/>
                    @endcannot

                </div>
            </div>
{{--            Middle--}}
            <div class="grow overflow-y-auto">
                <div class="flex items-start p-5">
                    <img src="{{ !str_contains($post->owner->image, 'users/') ? $post->owner->image : asset('storage/' . $post->owner->image) }}" class="mr-5 object-cover h-10 w-10 rounded-full">
                    <div>
                        <a href="{{$post->owner->username}}" class="font-bold">{{$post->owner->username}}</a>
                        {{$post->description}}
                    </div>
                </div>
{{--                Comments--}}
                @foreach($post->comments as $comment)
                    <div class="flex items-start px-5 py-2">
                        <img src="{{ !str_contains($comment->owner->image, 'users/') ? $comment->owner->image : asset('storage/' . $comment->owner->image) }}" class="h-10 object-cover w-10 mr-5 rounded-full">
                        <div class="flex flex-col">
                            <div class="break-all">
                                <a href="/{{$comment->owner->username}}" class="font-bold">{{$comment->owner->username}}</a>
                                {{$comment->body}}
                            </div>
                            <div class="mt-1 text-sm font-bold text-gray-400">
                                {{$comment->created_at->diffForHumans(null, true, true)}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="p-3 border-t flex flex-row" dir="{{app()->getLocale() == 'ar' ? 'rtl' : 'ltr'}}">
                <livewire:like :post="$post"/>
                <a class="grow" onclick="document.getElementById('comment_body').focus()">
                    <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer"></i>
                </a>
            </div>
            <livewire:likedby :postId="$post->id"/>

            <div class="border-t-2 dark:border-t-gray-500 p-5">
                <form action="/p/{{$post->slug}}/comment" method="POST">
                    @csrf
                    <div class="flex flex-row">
                        <textarea name="body" id="comment_body" placeholder="{{__('Add a comment...')}}" class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0 dark:bg-transparent dark:text-gray-300"></textarea>
                        <button type="submit" class="ml-5 border-none bg-white text-blue-500 dark:bg-transparent dark:text-indigo-100">
                            {{__('POST')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
