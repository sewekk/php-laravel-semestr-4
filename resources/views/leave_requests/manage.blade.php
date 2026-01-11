<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zarządzanie wnioskami') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-table.table>
                    <x-slot name="header">
                        <x-table.th>{{ __('Pracownik') }}</x-table.th>
                        <x-table.th>{{ __('Od') }}</x-table.th>
                        <x-table.th>{{ __('Do') }}</x-table.th>
                        <x-table.th>{{ __('Status') }}</x-table.th>
                        <x-table.th class="text-right">{{ __('Akcje') }}</x-table.th>
                    </x-slot>

                    @foreach($allRequests as $request)
                        <tr>
                            <x-table.td class="font-medium text-gray-900">{{ $request->user->name }}</x-table.td>
                            <x-table.td>{{ $request->start_date }}</x-table.td>
                            <x-table.td>{{ $request->end_date }}</x-table.td>
                            <x-table.td>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $request->status === 'approved' ? 'bg-green-100 text-green-800' :
                                       ($request->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ __($request->status) }}
                                </span>
                            </x-table.td>
                            <x-table.td class="text-right">
                                @can('decide-on-request')
                                    @if($request->status === 'pending')
                                        <div class="flex justify-end gap-x-2">
                                            <form action="{{ route('leave-requests.approve', $request) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="text-green-600 hover:text-green-900">Akceptuj</button>
                                            </form>
                                            <form action="{{ route('leave-requests.reject', $request) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Odrzuć</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm italic">Decyzja podjęta</span>
                                    @endif
                                @else
                                    <span class="text-gray-400 text-sm">Tylko wgląd</span>
                                @endcan
                            </x-table.td>
                        </tr>
                    @endforeach
                </x-table.table>
            </div>
        </div>
    </div>
</x-app-layout>
