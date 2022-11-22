<x-app-layout>
    <div class="w-full px-4">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded bg-white">
            <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-lg text-slate-700">
                            {{ __('Hospital Information') }}
                        </h3>
                    </div>
                </div>
            </div>


            

            <div class="block w-full overflow-x-auto">






                <div class="w-full md:w-1/3">
                    <div class="bg-white mb-6 text-center shadow-lg rounded-lg relative flex flex-col min-w-0 break-words w-full mb-6 rounded-lg">
                        <div class="bg-transparent first:rounded-t px-5 py-3 border-b border-blueGray-200">
                            <h6 class="font-bold my-2">Standard</h6>
                        </div>
                        <div class="px-4 py-5 flex-auto">
                            <div class="text-5xl mt-0 mb-0 font-bold">$25</div>
                            <span> per month </span>
                            <ul class="mt-6 mb-0 list-none">
                                <li class="py-1 text-blueGray-500">
                                    <b class="text-lightBlue-500"> 20GB </b>File Storage
                                </li>
                                <li class="py-1 text-blueGray-500">
                                    <b class="text-lightBlue-500"> 15 </b>Users/project
                                </li>
                                <li class="py-1 text-blueGray-500">
                                    <b class="text-lightBlue-500"> 4.000 </b>Internal messages
                                </li>
                            </ul>
                        </div>
                        <div class="mt-4 py-6 bg-transparent bg-transparent rounded-b px-4 py-3 border-t border-blueGray-200">
                            <a href="javascript:;" class="text-lightBlue-500">Request a demo</a>
                        </div>
                    </div>
                </div>





                {{-- <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                    <tr>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-slate-50 text-slate-500 border-slate-100">
                            title
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-slate-50 text-slate-500 border-slate-100">
                            Name
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-slate-50 text-slate-500 border-slate-100">
                            Username
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-slate-50 text-slate-500 border-slate-100">
                            Email
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-slate-50 text-slate-500 border-slate-100">
                            Added On
                        </th>
                        <th class="px-6 align-middle border border-solid py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left bg-slate-50 text-slate-500 border-slate-100">
                            Updated On
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $hospitalSettings->title }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $hospitalSettings->name }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $hospitalSettings->username }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $hospitalSettings->email }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $hospitalSettings->created_at }}
                            </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                {{ $hospitalSettings->updated_at }}
                            </td>
                        </tr>

                    </tbody>
                </table> --}}
            </div>
        </div>

        {{-- {{ $users->links() }} --}}

    </div>
</x-app-layout>
