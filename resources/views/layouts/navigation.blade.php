<nav x-data="{ open: false }" class="bg-white dark:bg-neutral-900 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-auto w-32 fill-current text-gray-800 dark:text-gray-200"/>
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">
                <livewire:search />
            </div>

            <div class="flex items-center">
                <button
                    class="p-2 bg-gray-100 dark:bg-neutral-950 text-gray-900 dark:text-gray-100 rounded-full flex items-center"
                    id="darkModeButton"
                >
                    <i class='bx bxs-sun' id="sunIcon" style="display:inline;"></i>
                    <i class='bx bxs-moon' id="moonIcon" style="display:none;"></i>
                </button>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest()
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-nav-link>
                @endguest
                @auth()
                    <div class=" hidden md:flex md:flex-row space-x-3 items-center justify-center text-[1.6rem] mr-2 leading-5">
                        <a href="{{route('home')}}">
                            {!!url()->current() == route('home') ?
                            '<i class="bx bxs-home-alt-2 dark:text-gray-100"></i>' :
                            '<i class="bx bx-home-alt-2 dark:text-gray-100"></i>'!!}
                        </a>

                        <a href="{{route('explore')}}">
                            {!!url()->current() == route('explore') ?
                            '<i class="bx bxs-compass dark:text-gray-100"></i>' :
                            '<i class="bx bx-compass dark:text-gray-100"></i>'!!}
                        </a>

                        <button onclick="Livewire.dispatch('openModal', { component: 'create-post-modal' })">
                            <i class="bx bx-message-square-add dark:text-gray-100"></i>
                        </button>

                        <div class="hidden md:block dark:text-gray-100">
                            <x-dropdown align="right" width="96">
                                <x-slot name="trigger">
                                    <button class="text-[1.6rem] ltr:mr-2 rtl:ml-2 leading-5">
                                        <div class="relative">
                                            <i class="bx bxs-inbox dark:text-gray-100"></i>
                                            <livewire:pending-followers-count />
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <livewire:pending-followers-list />
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>

                @endauth
                    <div class="hidden md:block">
                <x-dropdown align="right" width="48">
                    @auth()
                    <x-slot name="trigger">
                        <div class="ml-3">
                            <img src="{{!str_contains(auth()->user()->image , 'users/') ? auth()->user()->image : asset('storage/'.auth()->user()->image)}}" class="w-6 h-6 object-cover rounded-full">
                        </div>
                    </x-slot>
                    @endauth

                    <x-slot name="content">
                        @auth()
                        <x-dropdown-link :href="route('user_profile', ['user' => auth()->user()->username])">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @endauth
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                    </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @guest()
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endguest
            @auth()
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            @endauth

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('home')">
                    {{ __('Home') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link class="cursor-pointer" onclick="Livewire.dispatch('openModal', { component: 'create-post-modal' })">
                    {{ __('Create Post') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('explore')">
                    {{ __('Explore') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
