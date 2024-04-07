<div class="relative flex items-center">
    <input type="text" name="search" wire:model.live="searchInput"
           class="w-56 md:w-64 lg:w-96 border-none bg-gray-100 dark:bg-neutral-950 dark:text-gray-100 rounded-xl h-10 focus:ring-0"
           placeholder="{{__('Search...')}}"
           autocomplete="off" />
    @if(!empty($searchInput))
        <button class="absolute right-3" wire:click="clear">
            <i class="bx bx-x-circle text-gray-400"></i>
        </button>
    @endif

  <div>
      @if (!empty($results) and !empty($searchInput))
          <ul class="absolute w-56 md:w-64 lg:w-96 bg-white dark:bg-neutral-950 p-2 border border-neutral-300 dark:border-none dark:text-gray-100 z-10 rounded-lg shadow-xl left-0 top-10">
              @forelse($results as $result)
                  <li class="flex flex-row w-full p-3 items-center text-sm hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                      wire:key="user-{{ $result->id }}"
                      wire:click="goto('{{ $result->username }}')">
                      <div class="mr-3">
                          <img src="{{ !str_contains($result->image, 'users/') ? $result->image : asset('storage/' . $result->image) }}"
                               class="w-10 h-10 object-cover ltr:mr-2 rtl:ml-2 rounded-full border border-neutral-300">
                      </div>
                      <div class="flex flex-col grow">
                          <div class="font-bold">
                              <a href="/{{ $result->username }}">{{ $result->username }}</a>
                          </div>
                          <div class="text-sm text-neutral-500">
                              {{ $result->name }}
                          </div>
                      </div>
                  </li>
              @empty
                  <li class="w-full p-3 text-center">
                      {{ __('There are no results') }}
                  </li>
              @endforelse
          </ul>
      @endif
  </div>
</div>