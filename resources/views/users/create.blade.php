<x-app-layout>
    <div class="w-full px-4">
        <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="px-4 py-3 mb-0 border-0 rounded-t">
                <div class="flex flex-wrap items-center">
                    <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                        <h3 class="text-lg font-semibold text-slate-700">
                            {{ __('Add a User') }}
                        </h3>
                    </div>
                </div>
            </div>

            {{-- <div class="relative px-6 py-4 mb-4 text-gray-700 border-0 rounded">
                <span class="justify-center inline-block align-middle justify-evenly">
                    @foreach (App\Joseph\Helper::getRoles() as $key => $role)
                        <a
                            href="{{ route('users.index', ['role' => $role->id]) }}"
                            class="inline-flex items-center px-3 py-2 mr-1 text-xs font-bold
                                    leading-none uppercase rounded-full shadow-md bg-slate-300 shadow-slate-200
                                    {{ Str::lower($role->name) == Str::replaceFirst('users.'.''.$currentUrl) ? 'bg-slate-500 shadow-slate-400' : '' }}" --}}
                            {{-- class="inline-flex items-center px-3 py-1 mr-1 text-xs font-bold leading-none uppercase border-b-4 rounded-full bg-slate-500" --}}
                        {{-- >
                            {{ $role->name }}
                        </a>
                    @endforeach
                </span>
            </div> --}}

            <div class="block w-full overflow-x-auto">



            </div>
        </div>

        {{-- {{ $users->links() }} --}}

    </div>
</x-app-layout>
