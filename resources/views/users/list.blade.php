<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Użytkownicy') }}
            </h2>

            @if(Auth::user()->isAdmin())
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-user')">
                    {{ __('+ Dodaj pracownika') }}
                </x-primary-button>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <x-table.table>
                    <x-slot name="header">
                        <x-table.th>{{ __('Pracownik') }}</x-table.th>
                        <x-table.th>{{ __('Email') }}</x-table.th>
                        <x-table.th>{{ __('Rola') }}</x-table.th>
                        <x-table.th>{{ __('Status') }}</x-table.th>
                        <x-table.th class="text-right">{{ __('Akcje') }}</x-table.th>
                    </x-slot>

                    @foreach($users as $user)
                        <tr>
                            <x-table.td class="font-medium text-gray-900">
                                {{ $user->name }}
                            </x-table.td>

                            <x-table.td>{{ $user->email }}</x-table.td>

                            <x-table.td>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium capitalize
                                    {{ $user->isAdmin() ? 'bg-red-100 text-red-800' :
                                       ($user->isManager() ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $user->role }}
                                </span>
                            </x-table.td>

                            <x-table.td>
                                <div class="flex items-center">
                                    <div
                                        class="h-2.5 w-2.5 rounded-full {{ $user->is_active ? 'bg-green-500' : 'bg-red-500' }} me-2"></div>
                                    {{ $user->is_active ? __('Aktywny') : __('Nieaktywny') }}
                                </div>
                            </x-table.td>

                            <x-table.td class="text-right text-sm">
                                <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 transition">
                                    Edytuj
                                </a>
                            </x-table.td>
                        </tr>
                    @endforeach
                </x-table.table>

            </div>
        </div>
    </div>
    @if(Auth::user()->isAdmin())
        <x-modal name="add-user" :show="$errors->any()" focusable>
            @include('users.partials.add-user-form')
        </x-modal>

        <x-modal name="edit-user" :show="$errors->any()">
            @include('users.partials.edit-user-form')
        </x-modal>
    @endif
</x-app-layout>
