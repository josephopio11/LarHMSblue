<x-app-layout>
    <div class="w-full px-4">
        <div class="relative flex flex-col w-full min-w-0 mb-6 break-words bg-white rounded shadow-lg">
            <div class="px-4 py-3 mb-0 border-0 rounded-t">
                <div class="flex flex-wrap items-center">
                    <div class="relative flex-1 flex-grow w-full max-w-full px-4">
                        <h3 class="text-lg font-semibold text-slate-700">
                            {{ __('Billings') }}
                        </h3>
                    </div>
                    <div>
                        <a href="{{ route('billings.create') }}" class="px-4 py-2 mr-1 text-white bg-green-600 rounded-lg shadow-lg shadow-green-600/50 hover:bg-green-800">Add Bill</a>
                    </div>
                </div>
            </div>



            <div class="block w-full overflow-x-auto">




                <table class="items-center w-full bg-transparent border-collapse">
                    <thead>

                    <tr>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Status
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Doctor Order
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Patient Visit
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Approved by
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Created by
                        </th>
                        <th class="px-6 py-3 text-xs font-semibold text-left uppercase align-middle border border-l-0 border-r-0 border-solid whitespace-nowrap bg-slate-50 text-slate-500 border-slate-100">
                            Updated by
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                         {{--
                            status
                        doctor_order_id
                        patient_visit_id
                        approved_by_id
                        created_by_id
                        updated_by_id
                            --}}
                    @foreach($billings as $billing)
                        <tr class="hover:bg-sky-50">
                            <td class="p-4 px-6 align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                {{ $billing->status }}
                            </td>
                            <td class="p-4 px-6 text-xs font-bold align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                {{ $billing->doctorOrder->order_no }}
                            </td>
                            <td class="p-4 px-6 text-xs font-bold align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                {{ $billing->approvedBy->name }}
                            </td>
                            <td class="p-4 px-6 text-xs font-bold align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                {{ $billing->createdBy->name }}
                            </td>
                            <td class="p-4 px-6 text-xs font-bold align-middle border-t-0 border-l-0 border-r-0 whitespace-nowrap">
                                {{ $billing->updatedBy->name }}
                            </td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- {{ $billings->links() }} --}}

    </div>
</x-app-layout>
