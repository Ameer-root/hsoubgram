<x-app-layout>
<div class="flex flex-row max-w-3xl gap-8 mx-auto">
{{--    Left Side--}}
    <livewire:posts-list />
{{--    Right Side--}}
    <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4 dark:text-gray-100">
        <div class="flex flex-row text-sm">
            <div class="mr-5">
                <a href="/{{auth()->user()->username}}">
                    <img src="{{ !str_contains(auth()->user()->image, 'users/') ? auth()->user()->image : asset('storage/' . auth()->user()->image) }}" alt="{{auth()->user()->username}}" class="border border-gray-300 rounded-full w-12 h-12 object-cover">
                </a>
            </div>
            <div class="flex flex-col">
                <a href="/{{auth()->user()->username}}" class="font-bold">{{auth()->user()->username}}</a>
                <div class="text-gray-500 text-sm">{{auth()->user()->name}}</div>
            </div>
        </div>
        <div class="mt-5">
            <h3 class="text-gray-500 font-bold">{{__('Suggestions For You')}}</h3>
            <ul>
                @foreach($suggested_users as $suggested_user)
                    <li class="flex flex-row my-5 text-sm justify-items-center">
                        <div class="mr-5">
                            <a href="/{{$suggested_user->username}}">
                                <img src="{{ !str_contains($suggested_user->image, 'users/') ? $suggested_user->image : asset('storage/' . $suggested_user->image) }}" alt="{{$suggested_user->username}}" class="border border-gray-300 rounded-full w-9 h-9 object-cover">
                            </a>
                        </div>
                        <div class="flex flex-col grow">
                            <a href="/{{$suggested_user->username}}" class="font-bold">
                                {{$suggested_user->username}}
                            @if(auth()->user()->is_follower($suggested_user))
                                <span class="text-xs text-gray-500">{{__('Follower')}}</span>
                            @endif
                            </a>
                            <div class="text-gray-500 text-sm">{{ $suggested_user->name }}</div>
                        </div>
                        @if(auth()->user()->is_pending($suggested_user))
                            <span class="text-gray-500 font-bold">{{__('Pending')}}</span>
                        @else
{{--                        <a href="/{{$suggested_user->username}}/follow" class="text-blue-500 font-bold">{{__('Follow')}}</a>--}}
                            <livewire:follow-button :userId="$suggested_user->id"/>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
</x-app-layout>
