<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Moje wnioski urlopowe') }}
            </h2>

            @can('create-leave-request')
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-leave-request')">
                    {{ __('+ Nowy wniosek') }}
                </x-primary-button>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($leaveRequests->isEmpty())
                    <p class="text-gray-500 text-center py-4">
                        {{ Auth::user()->role === 'admin' ? __('Konto administratora nie posiada wniosków.') : __('Brak złożonych wniosków.') }}
                    </p>
                @else
                    <x-table.table>
                        <x-slot name="header">
                            <x-table.th>{{ __('Od') }}</x-table.th>
                            <x-table.th>{{ __('Do') }}</x-table.th>
                            <x-table.th>{{ __('Status') }}</x-table.th>
                            <x-table.th>{{ __('Data złożenia') }}</x-table.th>
                        </x-slot>

                        @foreach($leaveRequests as $request)
                            <tr>
                                <x-table.td>{{ $request->start_date }}</x-table.td>
                                <x-table.td>{{ $request->end_date }}</x-table.td>
                                <x-table.td>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $request->status === 'approved' ? 'bg-green-100 text-green-800' :
                                           ($request->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ __($request->status) }}
                                    </span>
                                </x-table.td>
                                <x-table.td>{{ $request->created_at->format('Y-m-d') }}</x-table.td>
                            </tr>
                        @endforeach
                    </x-table.table>
                @endif
            </div>
        </div>
    </div>

    @can('create-leave-request')
        <x-modal name="add-leave-request" :show="$errors->any()" focusable>
            @include('leave_requests.partials.add-request-form')
        </x-modal>
    @endcan
</x-app-layout>
