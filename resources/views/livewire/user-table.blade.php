<div>
<div class="relative px-6 py-4 mb-4 text-gray-700 border-0 rounded">
    <span class="justify-center inline-block align-middle justify-evenly">
        @foreach (App\Joseph\Helper::getRoles() as $key => $role)
            <a
                href="#"
                wire:click='"getUserDataByRole($role->name)"'
                class="inline-flex items-center px-3 py-2 mr-1 text-xs font-bold hover:bg-fuchsia-600 hover:text-white hover hover:shadow-lg hover:shadow-fuchsia-600/50
                        leading-none uppercase rounded-full shadow-md bg-slate-300 shadow-slate-200
                        {{ Str::lower($role->name) == Str::replaceFirst('users.','',$currentUrl)
                         ? 'bg-red-500 shadow-slate-400' : '' }}"
                {{-- class="inline-flex items-center px-3 py-1 mr-1 text-xs font-bold leading-none uppercase border-b-4 rounded-full bg-slate-500" --}}
            >
                {{ Str::upper(str_replace('-', ' ' ,$role->name)) }}
            </a>
        @endforeach
    </span>
</div>

<div class="block w-full overflow-x-auto">
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
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                        {{ $user->name }}
                    </td>
                    <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                        {{ $user->email }}
                    </td>
                    <td class="p-4 px-6 text-xs align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                        @foreach ($user->getRoleNames() as $role)
                            <span class="inline-flex items-center px-2 py-1 mr-1 text-xs font-bold leading-none uppercase border-b-4 rounded-full bg-slate-500">
                                {{ Str::upper($role) }}
                            </span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- <div class="flex justify-evenly"> --}}
{{-- {{ $users->links() }} --}}
</div>
