<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edycja pracownika: ') }} {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(Auth::user()->isAdmin())
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('users.partials.update-user-information-form')
                    </div>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('users.partials.update-user-password-form')
                </div>
            </div>

            @if(Auth::user()->isAdmin() && $user->id !== Auth::user()->id)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg border-l-4 border-red-500">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Usuń konto</h2>
                            <p class="mt-1 text-sm text-gray-600">Trwałe usunięcie pracownika z systemu.</p>
                        </header>
                        <form method="post" action="{{ route('users.destroy', $user) }}" class="mt-6" onsubmit="return confirm('Czy na pewno chcesz usunąć?')">
                            @csrf
                            @method('delete')
                            <x-danger-button>Usuń konto pracownika</x-danger-button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
