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
            <div class="relative pt-12 pb-32 bg-pink-600 md:pt-32">
                <div class="w-full px-4 mx-auto md:px-10">
                    <div>
                        <!-- Card stats -->
                        <div class="flex flex-wrap">
                            <div class="w-full px-4 lg:w-6/12 xl:w-3/12">
                                <div
                                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                                                <h5 class="text-xs font-bold uppercase text-slate-400">
                                                    Traffic
                                                </h5>
                                                <span class="text-xl font-semibold text-slate-700">
                                                    999,897
                                                </span>
                                            </div>
                                            <div class="relative flex-initial w-auto pl-4">
                                                <div
                                                    class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-red-500 rounded-full shadow-lg">
                                                    <i class="far fa-chart-bar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-4 text-sm text-slate-400">
                                            <span class="mr-2 text-emerald-500">
                                                <i class="fas fa-arrow-up"></i> 3.48%
                                            </span>
                                            <span class="whitespace-nowrap">
                                                Since last month
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-4 lg:w-6/12 xl:w-3/12">
                                <div
                                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                                                <h5 class="text-xs font-bold uppercase text-slate-400">
                                                    New users
                                                </h5>
                                                <span class="text-xl font-semibold text-slate-700">
                                                    2,356
                                                </span>
                                            </div>
                                            <div class="relative flex-initial w-auto pl-4">
                                                <div
                                                    class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-orange-500 rounded-full shadow-lg">
                                                    <i class="fas fa-chart-pie"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-4 text-sm text-slate-400">
                                            <span class="mr-2 text-red-500">
                                                <i class="fas fa-arrow-down"></i> 3.48%
                                            </span>
                                            <span class="whitespace-nowrap"> Since last week </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-4 lg:w-6/12 xl:w-3/12">
                                <div
                                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                                                <h5 class="text-xs font-bold uppercase text-slate-400">
                                                    Sales
                                                </h5>
                                                <span class="text-xl font-semibold text-slate-700">
                                                    924
                                                </span>
                                            </div>
                                            <div class="relative flex-initial w-auto pl-4">
                                                <div
                                                    class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white bg-pink-500 rounded-full shadow-lg">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-4 text-sm text-slate-400">
                                            <span class="mr-2 text-orange-500">
                                                <i class="fas fa-arrow-down"></i> 1.10%
                                            </span>
                                            <span class="whitespace-nowrap"> Since yesterday </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full px-4 lg:w-6/12 xl:w-3/12">
                                <div
                                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
                                    <div class="flex-auto p-4">
                                        <div class="flex flex-wrap">
                                            <div class="relative flex-1 flex-grow w-full max-w-full pr-4">
                                                <h5 class="text-xs font-bold uppercase text-slate-400">
                                                    Performance
                                                </h5>
                                                <span class="text-xl font-semibold text-slate-700">
                                                    49,65%
                                                </span>
                                            </div>
                                            <div class="relative flex-initial w-auto pl-4">
                                                <div
                                                    class="inline-flex items-center justify-center w-12 h-12 p-3 text-center text-white rounded-full shadow-lg bg-lightBlue-500">
                                                    <i class="fas fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-4 text-sm text-slate-400">
                                            <span class="mr-2 text-emerald-500">
                                                <i class="fas fa-arrow-up"></i> 12%
                                            </span>
                                            <span class="whitespace-nowrap">
                                                Since last month
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-4 mx-auto -m-24 md:px-10">
                <div class="flex flex-wrap">
                    <div class="w-full px-4 mb-12 xl:w-8/12 xl:mb-0">
                        <div
                            class="relative flex flex-col w-full min-w-0 mb-6 break-words rounded shadow-lg bg-slate-700">
                            <div class="px-4 py-3 mb-0 bg-transparent rounded-t">
                                <div class="flex flex-wrap items-center">
                                    <div class="relative flex-1 flex-grow w-full max-w-full">
                                        <h6 class="mb-1 text-xs font-semibold uppercase text-slate-100">
                                            Overview
                                        </h6>
                                        <h2 class="text-xl font-semibold text-white">
                                            Sales value
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-auto p-4">
                                <!-- Chart -->
                                <div class="relative h-350-px">
                                    <canvas id="line-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4 xl:w-4/12">
                        <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
                            <div class="px-4 py-3 mb-0 bg-transparent rounded-t">
                                <div class="flex flex-wrap items-center">
                                    <div class="relative flex-1 flex-grow w-full max-w-full">
                                        <h6 class="mb-1 text-xs font-semibold uppercase text-slate-400">
                                            Performance
                                        </h6>
                                        <h2 class="text-xl font-semibold text-slate-700">
                                            Total orders
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-auto p-4">
                                <!-- Chart -->
                                <div class="relative h-350-px">
                                    <canvas id="bar-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap mt-4">
                    <div class="w-full px-4 mb-12 xl:w-8/12 xl:mb-0">
                        <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
                            <div class="px-4 py-3 mb-0 border-0 rounded-t">
                                <div class="flex flex-wrap items-center">
                                    <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                                        <h3 class="text-base font-semibold text-slate-700">
                                            Page visits
                                        </h3>
                                    </div>
                                    <div class="relative flex-1 flex-grow w-full max-w-full px-4 text-right">
                                        <button
                                            class="px-3 py-1 mb-1 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-indigo-500 rounded outline-none active:bg-indigo-600 focus:outline-none"
                                            type="button">
                                            See all
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="block w-full overflow-x-auto">
                                <!-- Projects table -->
                                <table class="items-center w-full bg-transparent border-collapse">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-slate-50 text-slate-500 border-slate-100 whitespace-nowrap">
                                                Page name
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-slate-50 text-slate-500 border-slate-100 whitespace-nowrap">
                                                Visitors
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-slate-50 text-slate-500 border-slate-100 whitespace-nowrap">
                                                Unique users
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-slate-50 text-slate-500 border-slate-100 whitespace-nowrap">
                                                Bounce rate
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                /argon/
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                4,569
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                340
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <i class="mr-4 fas fa-arrow-up text-emerald-500"></i>
                                                46,53%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                /argon/index.html
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                3,985
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                319
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <i class="mr-4 text-orange-500 fas fa-arrow-down"></i>
                                                46,53%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                /argon/charts.html
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                3,513
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                294
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <i class="mr-4 text-orange-500 fas fa-arrow-down"></i>
                                                36,49%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                /argon/tables.html
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                2,050
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                147
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <i class="mr-4 fas fa-arrow-up text-emerald-500"></i>
                                                50,87%
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                /argon/profile.html
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                1,795
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                190
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <i class="mr-4 text-red-500 fas fa-arrow-down"></i>
                                                46,53%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-4 xl:w-4/12">
                        <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
                            <div class="px-4 py-3 mb-0 border-0 rounded-t">
                                <div class="flex flex-wrap items-center">
                                    <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                                        <h3 class="text-base font-semibold text-slate-700">
                                            Social traffic
                                        </h3>
                                    </div>
                                    <div class="relative flex-1 flex-grow w-full max-w-full px-4 text-right">
                                        <button
                                            class="px-3 py-1 mb-1 mr-1 text-xs font-bold text-white uppercase transition-all duration-150 ease-linear bg-indigo-500 rounded outline-none active:bg-indigo-600 focus:outline-none"
                                            type="button">
                                            See all
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="block w-full overflow-x-auto">
                                <!-- Projects table -->
                                <table class="items-center w-full bg-transparent border-collapse">
                                    <thead class="thead-light">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-slate-50 text-slate-500 border-slate-100 whitespace-nowrap">
                                                Referral
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-slate-50 text-slate-500 border-slate-100 whitespace-nowrap">
                                                Visitors
                                            </th>
                                            <th
                                                class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid bg-slate-50 text-slate-500 border-slate-100 whitespace-nowrap min-w-140-px">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                Facebook
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                1,480
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="mr-2">60%</span>
                                                    <div class="relative w-full">
                                                        <div
                                                            class="flex h-2 overflow-hidden text-xs bg-red-200 rounded">
                                                            <div style="width: 60%"
                                                                class="flex flex-col justify-center text-center text-white bg-red-500 shadow-none whitespace-nowrap">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                Facebook
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                5,480
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="mr-2">70%</span>
                                                    <div class="relative w-full">
                                                        <div
                                                            class="flex h-2 overflow-hidden text-xs rounded bg-emerald-200">
                                                            <div style="width: 70%"
                                                                class="flex flex-col justify-center text-center text-white shadow-none whitespace-nowrap bg-emerald-500">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                Google
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                4,807
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="mr-2">80%</span>
                                                    <div class="relative w-full">
                                                        <div
                                                            class="flex h-2 overflow-hidden text-xs bg-purple-200 rounded">
                                                            <div style="width: 80%"
                                                                class="flex flex-col justify-center text-center text-white bg-purple-500 shadow-none whitespace-nowrap">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                Instagram
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                3,678
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="mr-2">75%</span>
                                                    <div class="relative w-full">
                                                        <div
                                                            class="flex h-2 overflow-hidden text-xs rounded bg-lightBlue-200">
                                                            <div style="width: 75%"
                                                                class="flex flex-col justify-center text-center text-white shadow-none whitespace-nowrap bg-lightBlue-500">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th
                                                class="p-4 px-6 text-xs text-left align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                twitter
                                            </th>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                2,645
                                            </td>
                                            <td
                                                class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <span class="mr-2">30%</span>
                                                    <div class="relative w-full">
                                                        <div
                                                            class="flex h-2 overflow-hidden text-xs bg-orange-200 rounded">
                                                            <div style="width: 30%"
                                                                class="flex flex-col justify-center text-center text-white shadow-none whitespace-nowrap bg-emerald-500">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="block py-4">
                    <div class="container px-4 mx-auto">
                        <hr class="mb-4 border-b-1 border-slate-200" />
                        <div class="flex flex-wrap items-center justify-center md:justify-between">
                            <div class="w-full px-4 md:w-4/12">
                                <div class="py-1 text-sm font-semibold text-center text-slate-500 md:text-left">
                                    Copyright © <span id="get-current-year"></span>
                                    <a href="https://www.creative-tim.com?ref=njs-dashboard"
                                        class="py-1 text-sm font-semibold text-slate-500 hover:text-slate-700">
                                        Creative Tim
                                    </a>
                                </div>
                            </div>
                            <div class="w-full px-4 md:w-8/12">
                                <ul class="flex flex-wrap justify-center list-none md:justify-end">
                                    <li>
                                        <a href="https://www.creative-tim.com?ref=njs-dashboard"
                                            class="block px-3 py-1 text-sm font-semibold text-slate-600 hover:text-slate-800">
                                            Creative Tim
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.creative-tim.com/presentation?ref=njs-dashboard"
                                            class="block px-3 py-1 text-sm font-semibold text-slate-600 hover:text-slate-800">
                                            About Us
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://blog.creative-tim.com?ref=njs-dashboard"
                                            class="block px-3 py-1 text-sm font-semibold text-slate-600 hover:text-slate-800">
                                            Blog
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://github.com/creativetimofficial/notus-js/blob/main/LICENSE.md?ref=njs-dashboard"
                                            class="block px-3 py-1 text-sm font-semibold text-slate-600 hover:text-slate-800">
                                            MIT License
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

    @yield('scripts')

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
