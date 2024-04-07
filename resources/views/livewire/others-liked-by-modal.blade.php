<div class="max-h-96 flex flex-col dark:bg-neutral-800 dark:text-gray-100">
    <div class="flex w-full items-center border-b border-b-neutral-100 p-2">
    <h1 class="text-lg font-bold text-center pb-2 grow">{{__('Others')}}</h1>
    <button wire:click="$dispatch('closeModal')"><i class="bx bx-x text-xl"></i></button>
    </div>
    <ul class="overflow-y-auto">
        @foreach($this->other_users as $other)
            <li class="flex flex-row w-full p-3 items-center text-sm">
                <div class="mr-3">
                    <img src="{{ !str_contains($other->image, 'users/') ? $other->image : asset('storage/' . $other->image) }}" class="rounded-full w-8 h-8 object-cover border border-b-neutral-300" alt="{{$other->username}}">
                </div>
                <div class="flex flex-col grow">
                    <div class="font-bold">
                        <a href="/{{$other->username}}">{{$other->username}}</a>
                    </div>
                    <div class="text-sm text-neutral-500">
                        {{$other->name}}
                    </div>
                </div>

                    @if(auth()->user()->following()->wherePivot('following_user_id', $other->id)->exists())
                    <livewire:follow-button :post="$other" :userId="$other->id"/>
                @else
                        @if(auth()->user()->id == $other->id)
                           🥰
                    @else
                        <livewire:follow-button :post="$other" :userId="$other->id"/>
                    @endif
                @endif
            </li>

        @endforeach
    </ul>
{{--    <strong>--}}
{{--        @foreach($this->other as $ot)--}}
{{--            <a href="/{{$ot}}">{{$ot}}</a>--}}
{{--        @endforeach--}}
{{--    </strong>--}}
</div>
