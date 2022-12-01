<x-app-layout>
    <div class="relative pt-12 pb-32 bg-pink-600 md:pt-32">
        <div class="w-full px-4 mx-auto md:px-10">
            <!-- Card stats -->
            <div class="flex flex-wrap">
                <div class="w-full px-4 lg:w-6/12 xl:w-3/12">
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
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
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
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
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
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
                    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white rounded shadow-lg xl:mb-0">
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
    <div class="w-full px-4 mx-auto -m-24 md:px-10">

        <div class="flex flex-wrap">
            <div class="w-full px-4 mb-12 xl:w-8/12 xl:mb-0">
                <div class="relative flex flex-col w-full min-w-0 mb-6 break-words rounded shadow-lg bg-slate-700">
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
                                                <div class="flex h-2 overflow-hidden text-xs bg-red-200 rounded">
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
                                                <div class="flex h-2 overflow-hidden text-xs rounded bg-emerald-200">
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
                                                <div class="flex h-2 overflow-hidden text-xs bg-purple-200 rounded">
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
                                                <div class="flex h-2 overflow-hidden text-xs rounded bg-lightBlue-200">
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
                                                <div class="flex h-2 overflow-hidden text-xs bg-orange-200 rounded">
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
</x-app-layout>

@push('modals')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
    <script type="text/javascript">
        /* Make dynamic date appear */
        (function() {
            if (document.getElementById("get-current-year")) {
                document.getElementById("get-current-year").innerHTML =
                    new Date().getFullYear();
            }
        })();
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
                placement: "bottom-start"
            });
            document.getElementById(dropdownID).classList.toggle("hidden");
            document.getElementById(dropdownID).classList.toggle("block");
        }

        (function() {
            /* Chart initialisations */
            /* Line Chart */
            var config = {
                type: "line",
                data: {
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July"
                    ],
                    datasets: [{
                            label: new Date().getFullYear(),
                            backgroundColor: "#4c51bf",
                            borderColor: "#4c51bf",
                            data: [65, 78, 66, 44, 56, 67, 75],
                            fill: false
                        },
                        {
                            label: new Date().getFullYear() - 1,
                            fill: false,
                            backgroundColor: "#fff",
                            borderColor: "#fff",
                            data: [40, 68, 86, 74, 56, 60, 87]
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    title: {
                        display: false,
                        text: "Sales Charts",
                        fontColor: "white"
                    },
                    legend: {
                        labels: {
                            fontColor: "white"
                        },
                        align: "end",
                        position: "bottom"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            ticks: {
                                fontColor: "rgba(255,255,255,.7)"
                            },
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: "Month",
                                fontColor: "white"
                            },
                            gridLines: {
                                display: false,
                                borderDash: [2],
                                borderDashOffset: [2],
                                color: "rgba(33, 37, 41, 0.3)",
                                zeroLineColor: "rgba(0, 0, 0, 0)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2]
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                fontColor: "rgba(255,255,255,.7)"
                            },
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: "Value",
                                fontColor: "white"
                            },
                            gridLines: {
                                borderDash: [3],
                                borderDashOffset: [3],
                                drawBorder: false,
                                color: "rgba(255, 255, 255, 0.15)",
                                zeroLineColor: "rgba(33, 37, 41, 0)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2]
                            }
                        }]
                    }
                }
            };
            var ctx = document.getElementById("line-chart").getContext("2d");
            window.myLine = new Chart(ctx, config);

            /* Bar Chart */
            config = {
                type: "bar",
                data: {
                    labels: [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July"
                    ],
                    datasets: [{
                            label: new Date().getFullYear(),
                            backgroundColor: "#ed64a6",
                            borderColor: "#ed64a6",
                            data: [30, 78, 56, 34, 100, 45, 13],
                            fill: false,
                            barThickness: 8
                        },
                        {
                            label: new Date().getFullYear() - 1,
                            fill: false,
                            backgroundColor: "#4c51bf",
                            borderColor: "#4c51bf",
                            data: [27, 68, 86, 74, 10, 4, 87],
                            barThickness: 8
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    title: {
                        display: false,
                        text: "Orders Chart"
                    },
                    tooltips: {
                        mode: "index",
                        intersect: false
                    },
                    hover: {
                        mode: "nearest",
                        intersect: true
                    },
                    legend: {
                        labels: {
                            fontColor: "rgba(0,0,0,.4)"
                        },
                        align: "end",
                        position: "bottom"
                    },
                    scales: {
                        xAxes: [{
                            display: false,
                            scaleLabel: {
                                display: true,
                                labelString: "Month"
                            },
                            gridLines: {
                                borderDash: [2],
                                borderDashOffset: [2],
                                color: "rgba(33, 37, 41, 0.3)",
                                zeroLineColor: "rgba(33, 37, 41, 0.3)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2]
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: "Value"
                            },
                            gridLines: {
                                borderDash: [2],
                                drawBorder: false,
                                borderDashOffset: [2],
                                color: "rgba(33, 37, 41, 0.2)",
                                zeroLineColor: "rgba(33, 37, 41, 0.15)",
                                zeroLineBorderDash: [2],
                                zeroLineBorderDashOffset: [2]
                            }
                        }]
                    }
                }
            };
            ctx = document.getElementById("bar-chart").getContext("2d");
            window.myBar = new Chart(ctx, config);
        })();
    </script>
@endpush
