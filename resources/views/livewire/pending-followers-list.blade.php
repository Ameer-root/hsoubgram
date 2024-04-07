<div>
    <ul class="p-3">
    @forelse(auth()->user()->pending_followers as $pending)
        <li class="flex flex-row w-full p-3 items-center text-sm">
            <div class="mr-3">
                <img src="{{ !str_contains($pending->image, 'users/') ? $pending->image : asset('storage/' . $pending->image) }}" class="rounded-full w-8 h-8 object-cover border border-b-neutral-300" alt="{{$pending->username}}">
            </div>
            <div class="flex flex-col grow">
                <div class="font-bold">
                    <a href="/{{$pending->username}}">{{$pending->username}}</a>
                </div>
                <div class="text-sm text-neutral-500 dark:text-gray-400">
                    {{$pending->name}}
                </div>
            </div>
                <button class="border border-blue-500 bg-blue-500 text-white px-2 py-1 rounded mr-2" wire:click="confirm({{ $pending->id }})">
                    {{__('Confirm')}}
                </button>

            <button class="border border-gray-500 dark:border-gray-100 px-2 py-1 rounded" wire:click="delete({{$pending->id}})">
                {{__('Delete')}}
            </button>
        </li>
    @empty
        <div class="text-center text-sm">
          {{__('No pending follow requests.')}}
        </div>
    @endforelse
    </ul>
</div>
