<nav class="relative z-10 flex flex-wrap items-center justify-between px-6 py-4 bg-white shadow-xl md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden md:w-64">
    <div class="flex flex-wrap items-center justify-between w-full px-0 mx-auto md:flex-col md:items-stretch md:min-h-full md:flex-nowrap">
        <button class="px-3 py-1 text-xl leading-none text-black bg-transparent border border-transparent border-solid rounded opacity-50 cursor-pointer md:hidden" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="inline-block p-4 px-0 mr-0 text-sm font-bold text-left uppercase md:block md:pb-2 text-slate-600 whitespace-nowrap" href="{{ route('dashboard') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <ul class="flex flex-wrap items-center list-none md:hidden">
            <li class="relative inline-block">
                <a
                    class="block text-slate-500"
                    href="#pablo"
                    onclick="openDropdown(event,'user-responsive-dropdown')"
                >
                    <div class="flex items-center">
                  <span
                      class="inline-flex items-center justify-center w-12 h-12 text-sm text-white rounded-full bg-slate-200"
                  ><img
                          alt="..."
                          class="w-full align-middle border-none rounded-full shadow-lg"
                          src="https://eu.ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                      /></span></div>
                </a>
                <div
                    class="z-50 hidden float-left py-2 text-base text-left list-none bg-white rounded shadow-lg min-w-48"
                    id="user-responsive-dropdown"
                >
                    <div
                        class="h-0 my-2 border border-solid border-slate-100"
                    ></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block w-full px-4 py-2 text-sm font-normal bg-transparent whitespace-nowrap text-slate-700"
                        >{{ __('Log Out') }}</a
                        >
                    </form>
                </div>
            </li>
        </ul>
        <div class="absolute top-0 left-0 right-0 z-40 items-center flex-1 hidden h-auto overflow-x-hidden overflow-y-auto rounded shadow md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none" id="example-collapse-sidebar">
            <div class="block pb-4 mb-4 border-b border-solid md:min-w-full md:hidden border-slate-200">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="inline-block p-4 px-0 mr-0 text-sm font-bold text-left uppercase md:block md:pb-2 text-slate-600 whitespace-nowrap"  href="{{ route('dashboard') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="flex justify-end w-6/12">
                        <button type="button" class="px-3 py-1 text-xl leading-none text-black bg-transparent border border-transparent border-solid rounded opacity-50 cursor-pointer md:hidden" onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Heading -->
            <x-nav-heading>
                {{ __('Admin Layout Pages') }}
            </x-nav-heading>

            <!-- Navigation -->

            <ul class="flex flex-col list-none md:flex-col md:min-w-full">
                <li class="items-center">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-tv"></i>
                        </x-slot>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>
                <x-divider class="my-4" />

                <x-nav-heading>
                    Administrative
                </x-nav-heading>



                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('HR Management') }}
                    </x-nav-link>
                </li>


                {{-- Links inserted by Joseph Opio --}}


                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('account.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Account') }}
                    </x-nav-link>
                </li>

                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('appointment.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Appointments') }}
                    </x-nav-link>
                </li>


                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('department.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Departments') }}
                    </x-nav-link>
                </li>

                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('department.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('PT Management') }}
                    </x-nav-link>
                </li>

                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('labs.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Lab Management') }}
                    </x-nav-link>
                </li>


                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('pharmacy.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Pharmacy Management') }}
                    </x-nav-link>
                </li>

                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('pharmacy.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Blood Management') }}
                    </x-nav-link>
                </li>

                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('pharmacy.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Room Management') }}
                    </x-nav-link>
                </li>

                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('pharmacy.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('ABM Management') }}
                    </x-nav-link>
                </li>

                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('pharmacy.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Inventory Management') }}
                    </x-nav-link>
                </li>

                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('pharmacy.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Assets Management') }}
                    </x-nav-link>
                </li>
                <li class="items-center">
                    <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('pharmacy.*')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 fas fa-users"></i>
                        </x-slot>
                        {{ __('Reports') }}
                    </x-nav-link>
                </li>


                {{-- /Links inserted by Joseph Opio --}}



                <li class="items-center">
                    <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                        <x-slot name="icon">
                            <i class="mr-2 text-sm opacity-75 far fa-address-card"></i>
                        </x-slot>
                        {{ __('About us') }}
                    </x-nav-link>
                </li>
            </ul>

            <x-divider class="my-4" />

            <x-nav-heading>
                Two-level menu
            </x-nav-heading>

            <ul class="flex flex-col list-none md:flex-col md:min-w-full">
                <x-nav-link href="#">
                    <x-slot name="icon">
                        <i class="mr-2 text-sm opacity-75 far fa-circle"></i>
                    </x-slot>
                    Child menu
                </x-nav-link>
            </ul>
        </div>
    </div>
</nav>
