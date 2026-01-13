<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Zarządzanie czasem pracy') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-table.table>
                    <x-slot name="header">
                        <x-table.th>{{ __('Pracownik') }}</x-table.th>
                        <x-table.th>{{ __('Rozpoczęcie') }}</x-table.th>
                        <x-table.th>{{ __('Zakończenie') }}</x-table.th>
                        <x-table.th>{{ __('Czas trwania') }}</x-table.th>
                        <x-table.th>{{ __('Status') }}</x-table.th>
                        <x-table.th class="text-right">{{ __('Akcje') }}</x-table.th>
                    </x-slot>

                    @forelse($allRequests as $time)
                        <tr>
                            <x-table.td class="font-medium text-gray-900">
                                {{ $time->user->name }}
                            </x-table.td>
                            <x-table.td>{{ $time->start_at->format('Y-m-d H:i') }}</x-table.td>
                            <x-table.td>{{ $time->end_at->format('Y-m-d H:i') }}</x-table.td>
                            <x-table.td>
                                {{ floor($time->duration_minutes / 60) }}h {{ $time->duration_minutes % 60 }}min
                            </x-table.td>
                            <x-table.td>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $time->status === 'approved' ? 'bg-green-100 text-green-800' :
                                       ($time->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ __($time->status) }}
                                </span>
                            </x-table.td>
                            <x-table.td class="text-right text-sm">
                                @can('manage-work-times')
                                    @if($time->status === 'pending')
                                        <div class="flex justify-end gap-x-2">
                                            <form action="{{ route('work-times.approve', $time) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-green-600 hover:text-green-900 font-medium">
                                                    {{ __('Akceptuj') }}
                                                </button>
                                            </form>
                                            <form action="{{ route('work-times.reject', $time) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                                    {{ __('Odrzuć') }}
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">{{ __('Decyzja podjęta') }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400 italic">{{ __('Tylko wgląd') }}</span>
                                @endcan
                            </x-table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-table.td colspan="6" class="text-center py-8 text-gray-500">
                                {{ __('Brak wpisów do wyświetlenia.') }}
                            </x-table.td>
                        </tr>
                    @endforelse
                </x-table.table>
            </div>
        </div>
    </div>
</x-app-layout>
