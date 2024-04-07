<x-app-layout>
    <div class="grid grid-cols-4">
{{--        User Image--}}
        <div class="px-4 col-span-1 order-1">
            <img src="{{ !str_contains($user->image, 'users/') ? $user->image : asset('storage/' . $user->image) }}" alt="{{$user->username}}'s profile picture" class="rounded-full object-cover w-20 h-20 md:w-40 md:h-40 border border-neutral-300">
        </div>

{{--        Username and buttons--}}
        <div class="px-4 col-span-2 md:ml-0 flex flex-row items-start order-2 md:col-span-3 dark:text-gray-100">
            <div class="text-3xl my-10">{{$user->username}}</div>
            <div class="ml-3 my-12">
                @auth()
                    @if($user->id === auth()->user()->id)
                    <a href="{{route('profile.edit')}}" class="w-44 border text-sm font-bold px-5 py-1 rounded-md border-neutral-300 text-center dark:bg-neutral-900 dark:border-none">{{__('Edit Profile')}}</a>
                    @else
                        <livewire:follow-button :userId="$user->id"/>
                    @endif
                @endauth


                @guest()
                        <button class="w-30 text-black dark:text-white cursor-pointer text-sm font-bold py-1 px-3 text-center rounded">
                            <a href="{{route('login')}}">{{__('Follow')}}</a>
                        </button>
                @endguest
            </div>
        </div>

{{--        User Info--}}
        <div class="text-md mt-8 px-4 col-span-3 order-3 col-start-1 md:col-start-2 md:order-4 md:mt-0 dark:text-gray-100">
            <p class="font-bold">{{$user->name}}</p>
            {!! nl2br(e($user->bio)) !!}
        </div>

{{--        User stats--}}
        <div class="col-span-4 my-5 py-2 border-y border-y-neutral-200 order-4 md:order-3 md:border-none md:px-4 md:col-start-2">
            <ul class="text-md flex flex-row justify-around md:justify-start md:space-x-10 md:text-xl">
                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-1 font-bold md:font-normal dark:text-gray-100">
                        {{$user->posts->count()}}
                    </div>
                    <span class="text-neutral-500 md:text-black dark:text-gray-100">{{$user->posts->count() === 1 ? __('post') : __('posts')}}</span>
                </li>

                <li class="flex flex-col md:flex-row text-center">
                    <div class="md:mr-1 font-bold md:font-normal dark:text-gray-100">
                        {{$user->followers()->count()}}
                    </div>
                    <span class="text-neutral-500 md:text-black dark:text-gray-100">{{$user->followers()->count()  > 1 ? __('followers') : __('follower')}}</span>
                </li>
                <livewire:following :userId="$user->id" />

            </ul>
        </div>
    </div>

{{--    Bottom--}}
    @if($user->posts()->count() > 0 and ($user->private_account == false or auth()->id() == $user->id or ( auth()->user() and auth()->user()->is_following($user))))
        <div class="grid grid-cols-3 gap-1 my-5">
            @foreach($user->posts as $post)
                <a href="/p/{{$post->slug}}" class="aspect-square block w-full">
                    <img src="{{asset('storage/'.$post->image)}}" alt="{{$post->description}}" class="w-full aspect-square object-cover">
                </a>
            @endforeach
        </div>
    @else
        <div class="w-full text-center mt-20">
            @if($user->private_account == true and $user->id != auth()->id())
                <p class="text-neutral-500">{{__('This Account is Private. Follow to see their posts.')}}</p>
            @else
                <p class="text-neutral-500">{{__('This Account has no posts.')}}</p>
            @endif
        </div>
    @endif
</x-app-layout>
