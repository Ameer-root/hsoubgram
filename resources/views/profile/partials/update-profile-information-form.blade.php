<section>
    <div class="{{session('message') ? '' : 'hidden'}} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 absolute right-10 shadow shadow-neutral-200 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span class="font-medium">{{session('message')}}</span>
    </div>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update', ['user' => auth()->user()->username]) }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

            <div>
                <x-input-label for="username" :value="__('Username')" />
                <div class="flex rounded-md ring-1 ring-inset ring-gray-300 dark:border-indigo-600 dark:bg-neutral-950 dark:ring-gray-700 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 dark:focus-within:ring-indigo-600 p-0.5">
                    <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm rtl:pl-0 rtl:pr-3">hsoubgram.test/</span>
                    <x-text-input id="username" name="username" type="text" class="block flex-1 border-none focus:ring-0 rounded-md shadow-none dark:bg-transparent bg-transparent text-gray-900 placeholder:text-gray-400" :value="old('username', $user->username)" required autofocus autocomplete="username" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('username')" />

            </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

            <div>
                <x-input-label for="bio" :value="__('Bio')" />
                <div class="mt-2">
                    <textarea id="bio" name="bio" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 dark:ring-gray-700 dark:focus:ring-indigo-600 dark:bg-neutral-950 dark:text-gray-300">{{$user->bio ?? ''}}</textarea>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('bio')" />

            </div>

            <div>
                <x-input-label for="image" :value="__('Image')" />
                <div class="mt-2 flex items-center gap-x-3">
                    <img class="h-12 w-12 object-cover rounded-full" src="{{ !str_contains($user->image, 'users/') ? $user->image : asset('storage/' . $user->image) }}">
                    <input class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl dark:border-gray-700 dark:outline-none dark:bg-neutral-950 dark:text-gray-300" name="image" id="file_input" type="file">
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('image')" />

            </div>

        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input type="checkbox" name="private_account" class=" dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 h-4 w-4 text-indigo-600 rounded" @checked($user->private_account)>
            </div>
            <div class="ml-3 text-sm">
                <x-input-label for="private_account" :value="__('Private Account')" />
            </div>
        </div>

        <div class="col-span-6 sm:col-span-3">
            <label for="lang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Language') }}</label>
            <select id="lang" name="lang"
                    class="mt-1 block w-full rounded-md border border-gray-300 dark:border-none bg-white py-2 ltr:px-3 rtl:px-8 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm dark:bg-neutral-950 dark:text-gray-100">
                <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            </select>
        </div>


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>


{{--        <div>--}}
{{--            <x-input-label for="update_password_current_password" :value="__('Current Password')" />--}}
{{--            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />--}}
{{--            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />--}}
{{--        </div>--}}

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>


    </form>
</section>
