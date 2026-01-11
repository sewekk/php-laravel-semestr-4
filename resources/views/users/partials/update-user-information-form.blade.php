<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Informacje o pracowniku</h2>
        <p class="mt-1 text-sm text-gray-600">Zaktualizuj dane podstawowe i status konta.</p>
    </header>

    <form method="post" action="{{ route('users.update', $user) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <input type="hidden" name="password_confirmation" value="">

        <div>
            <x-input-label for="name" value="Imię i nazwisko" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="role" value="Rola w systemie" />
                <select id="role" name="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="employee" {{ old('role', $user->role) == 'employee' ? 'selected' : '' }}>Pracownik</option>
                    <option value="manager" {{ old('role', $user->role) == 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="administrator" {{ old('role', $user->role) == 'administrator' ? 'selected' : '' }}>Administrator</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('role')" />
            </div>

            <div class="flex items-center mt-6">
                <label for="is_active" class="inline-flex items-center">
                    <input id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                    <span class="ms-2 text-sm text-gray-700 font-semibold uppercase tracking-wide">Konto Aktywne</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-4 border-t pt-6">
            <x-primary-button>{{ __('Zapisz zmiany') }}</x-primary-button>

            @if (session('status') === 'user-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                    {{ __('Zapisano.') }}
                </p>
            @endif
        </div>
    </form>
</section>
