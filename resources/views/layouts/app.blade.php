<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="antialiased text-slate-700">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
        @include('layouts.navigation')
        <div class="relative md:ml-64 bg-slate-50">
            <nav
                class="absolute top-0 left-0 z-10 flex items-center w-full p-4 bg-transparent md:flex-row md:flex-nowrap md:justify-start">
                <div class="flex flex-wrap items-center justify-between w-full px-4 mx-autp md:flex-nowrap md:px-10">
                    <a class="hidden text-sm font-semibold text-white uppercase lg:inline-block"
                        href="{{ route('dashboard') }}">{{ __('Dashboard') }} || {{ config('app.name', "Laravel") }}</a>
                    <form class="flex-row flex-wrap items-center hidden mr-3 md:flex lg:ml-auto">
                        <div class="relative flex flex-wrap items-stretch w-full">
                            <span
                                class="absolute z-10 items-center justify-center w-8 h-full py-3 pl-3 text-base font-normal leading-snug text-center bg-transparent rounded text-slate-300"><i
                                    class="fas fa-search"></i></span>
                            <input type="text" placeholder="Search here..."
                                class="relative w-full px-3 py-3 pl-10 text-sm bg-white border-0 rounded shadow outline-none placeholder-slate-300 text-slate-600 focus:outline-none focus:ring" />
                        </div>
                    </form>
                    <div class="flex flex-wrap items-center justify-between mx-autp md:flex-nowrap md:px-10">
                        <x-dropdown>
                            <x-slot name="trigger">
                                <a class="flex flex-wrap items-center justify-end mx-auto text-slate-500 md:flex-nowrap md:px-10" href="#pablo"
                                    onclick="openDropdown(event,'user-dropdown')">
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center justify-center w-12 h-12 mr-2 text-sm text-white rounded-full bg-slate-200"><img
                                                alt="..." class="w-full align-middle border-none rounded-full shadow-lg"
                                                src="https://i.pravatar.cc/50?u={{ Auth()->user()->id }}" /></span>
                                    </div>
                                    <span class="text-white">{{ Auth::user()->name }}</span>
                                </a>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('profile.show') }}">{{ __('My profile') }}
                                </x-dropdown-link>
                                <x-divider />
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                </div>
            </nav>
            <!-- Header -->

            {{ $slot }}



        </div>
    </div>

    @stack('modals')

    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

    <script type="text/javascript">
        /* Sidebar - Side navigation menu on mobile/responsive mode */
        function toggleNavbar(collapseID) {
            document.getElementById(collapseID).classList.toggle("hidden");
            document.getElementById(collapseID).classList.toggle("bg-white");
            document.getElementById(collapseID).classList.toggle("m-2");
            document.getElementById(collapseID).classList.toggle("py-3");
            document.getElementById(collapseID).classList.toggle("px-6");
        }

        /* Function for dropdowns */
        function openDropdown(event, dropdownID) {
            let element = event.target;
            while (element.nodeName !== "A") {
                element = element.parentNode;
            }
            Popper.createPopper(element, document.getElementById(dropdownID), {
                placement: "bottom-start",
            });
            document.getElementById(dropdownID).classList.toggle("hidden");
            document.getElementById(dropdownID).classList.toggle("block");
        }
    </script>


</body>

</html>
