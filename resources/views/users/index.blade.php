<x-app-layout>
    <div class="w-full px-4">
        <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="px-4 py-3 mb-0 border-0 rounded-t">
                <div class="flex flex-wrap items-center">
                    <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                        <h3 class="text-lg font-semibold text-slate-700">
                            {{ __('Users') }}
                        </h3>
                    </div>
                    <div>
                        <a href="{{ route('users.create') }}">Add User</a>
                    </div>
                </div>
            </div>



            <div class="block w-full overflow-x-auto">




                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Name
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Email
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Role
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Gender
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-sky-50">
                            <td class="p-4 px-6 align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                <div class="flex items-center align-middle">
                                    <img src="https://i.pravatar.cc/50?u={{ $user->id }}" alt="" class="mr-2 rounded-full">
                                    <div class="flex-row items-center font-bold align-middle text-bold">
                                        <h4 cl>{{ $user->name }}</h4>
                                        <p class="text-xs text-gray-400">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 px-6 text-xs font-bold align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                <a href="mailto:{{ $user->email }}">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">

                                @foreach ($user->getRoleNames() as $role)
                                    <span class="inline-flex items-center px-3 py-1 mr-1 text-xs font-bold leading-none uppercase border-b-4 rounded-full bg-slate-500">
                                        {{ $role }}
                                    </span>

                                @endforeach
                            </td>
                            <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                {{ App\Joseph\Helper::getGenderValue($user->gender) }}
                            </td>
                            <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                {{ App\Joseph\Helper::getStatusValue($user->status) }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{ $users->links() }}

    </div>
</x-app-layout>
