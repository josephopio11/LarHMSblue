<x-app-layout>
    <div class="px-4 w-full">
        <div class="flex relative flex-col mb-6 min-w-0 break-words bg-white rounded shadow-lg bg-slate-100 xl:mb-0">

            <div class="px-6 py-6 mb-0 bg-white rounded-t">
                <div class="flex justify-between text-center">
                    <h6 class="text-xl font-bold text-slate-700">
                        {{ __('My profile') }}
                    </h6>
                </div>
            </div>

            <div class="flex-auto p-4">

                @if ($message = Session::get('success'))
                    <div class="text-white px-6 py-4 border-0 rounded relative mb-4 bg-emerald-500">
                        <span class="text-xl inline-block mr-5 align-middle">
                            <i class="fas fa-bell"></i>
                        </span>
                        <span class="inline-block align-middle mr-8">
                            <b class="capitalize">Success!</b> {{ $message }}
                        </span>
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-wrap">
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <x-input-label for="name" :value="__('Name')"/>
                                <x-text-input
                                        type="text"
                                        placeholder="{{ __('Name') }}"
                                        name="name"
                                        id="name"
                                        value="{{ old('name', auth()->user()->name) }}"
                                        required
                                />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <x-input-label for="email" :value="__('Email')"/>
                                <x-text-input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email', auth()->user()->email) }}"
                                        placeholder="{{ __('Email') }}"
                                        required
                                />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <x-input-label for="password" :value="__('New password')"/>
                                <x-text-input
                                        type="password"
                                        name="password"
                                        id="password"
                                        placeholder="{{ __('New password') }}"
                                />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <x-input-label for="password_confirmation" :value="__('New password confirmation')"/>
                                <x-text-input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        placeholder="{{ __('New password confirmation') }}"
                                />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <x-divider class="mt-6"/>

                    <div class="mt-6">
                        <x-primary-button>
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
