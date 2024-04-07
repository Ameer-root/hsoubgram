<div class="max-h-96 flex flex-col dark:bg-neutral-800 dark:text-gray-100">
    <div class="flex w-full items-center border-b border-b-neutral-100 p-2">
         <h1 class="text-lg font-bold text-center pb-2 grow">{{__('Following')}}</h1>
        <button wire:click="$dispatch('closeModal')"><i class="bx bx-x text-xl"></i></button>
    </div>
    <ul class="overflow-y-auto">
        @forelse($this->following_list as $following)
            <li class="flex flex-row w-full p-3 items-center text-sm" wire:key="{{$following->id}}">
                <div class="mr-3">
                    <img src="{{ !str_contains($following->image, 'users/') ? $following->image : asset('storage/' . $following->image) }}" class="rounded-full w-8 h-8 object-cover border border-b-neutral-300" alt="{{$following->username}}">
                </div>
                <div class="flex flex-col grow">
                    <div class="font-bold">
                        <a href="/{{$following->username}}">{{$following->username}}</a>
                    </div>
                    <div class="text-sm text-neutral-500">
                        {{$following->name}}
                    </div>
                </div>
                @auth()
                    @if($this->userId === auth()->id())
                    <div>
                        <button wire:click="unfollow({{$following->id}})" class="border border-gray-500 px-2 py-1 rounded">
                            {{__('Unfollow')}}
                        </button>
                    </div>
                    @endif
                @endauth
            </li>
        @empty
            @if(auth()->id() === $this->userId)
                <li class="w-full p-3 text-center">
                    {{__('Your are not following anyone.')}}
                </li>
            @else
                <li class="w-full p-3 text-center">
                    {{__('This user is not following anyone.')}}
                </li>
            @endif
        @endforelse
    </ul>
</div>
