<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ Auth::user()->role === 'employee' ? __('Mój czas pracy') : __('Zarządzanie czasem pracy') }}
            </h2>

            @can('add-work-time')
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-work-time')">
                    {{ __('+ Dodaj czas pracy') }}
                </x-primary-button>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(Auth::user()->role === 'employee')
                <div class="bg-white p-6 shadow-sm sm:rounded-lg border-l-4 border-indigo-500">
                    <div class="text-sm text-gray-500 uppercase font-bold">{{ __('Suma zatwierdzonych godzin') }}</div>
                    <div class="text-3xl font-bold text-gray-900">
                        {{ floor($totalMinutes / 60) }}h {{ $totalMinutes % 60 }}min
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <x-table.table>
                    <x-slot name="header">
                        @if(Auth::user()->role !== 'employee')
                            <x-table.th>{{ __('Pracownik') }}</x-table.th>
                        @endif
                        <x-table.th>{{ __('Rozpoczęcie') }}</x-table.th>
                        <x-table.th>{{ __('Zakończenie') }}</x-table.th>
                        <x-table.th>{{ __('Czas trwania') }}</x-table.th>
                        <x-table.th>{{ __('Status') }}</x-table.th>
                        <x-table.th class="text-right">{{ __('Akcje') }}</x-table.th>
                    </x-slot>

                    @foreach($workTimes as $time)
                        <tr>
                            @if(Auth::user()->role !== 'employee')
                                <x-table.td>{{ $time->user->name }}</x-table.td>
                            @endif
                            <x-table.td>{{ $time->start_at->format('Y-m-d H:i') }}</x-table.td>
                            <x-table.td>{{ $time->end_at->format('Y-m-d H:i') }}</x-table.td>
                            <x-table.td>{{ floor($time->duration_minutes / 60) }}h {{ $time->duration_minutes % 60 }}min</x-table.td>
                            <x-table.td>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $time->status === 'approved' ? 'bg-green-100 text-green-800' :
                                       ($time->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ __($time->status) }}
                                </span>
                                @if($time->manager_note)
                                    <div class="text-xs text-gray-500 mt-1 italic">Notatka: {{ $time->manager_note }}</div>
                                @endif
                            </x-table.td>
                            <x-table.td class="text-right text-sm">
                                @can('manage-work-times')
                                    @if($time->status === 'pending')
                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'decide-work-time-{{ $time->id }}')" class="text-indigo-600 hover:text-indigo-900">
                                            {{ __('Decyzja') }}
                                        </button>
                                    @else
                                        <span class="text-gray-400 italic">{{ __('Zakończono') }}</span>
                                    @endif
                                @endcan
                            </x-table.td>
                        </tr>
                    @endforeach
                </x-table.table>
            </div>
        </div>
    </div>

    @can('add-work-time')
        <x-modal name="add-work-time" :show="$errors->any()" focusable>
            @include('work_times.partials.add-work-time-form')
        </x-modal>
    @endcan

    @can('manage-work-times')
        @foreach($workTimes as $time)
            <x-modal name="decide-work-time-{{ $time->id }}" focusable>
                @include('work_times.partials.decide-work-time-form', ['time' => $time])
            </x-modal>
        @endforeach
    @endcan
</x-app-layout>
