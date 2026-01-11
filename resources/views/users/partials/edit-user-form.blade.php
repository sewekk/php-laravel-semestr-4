<div x-data="{
    id: '',
    name: '',
    email: '',
    role: '',
    is_active: true,
    deleteFormAction: ''
}"
     x-on:set-edit-user.window="
    id = $event.detail.id;
    name = $event.detail.name;
    email = $event.detail.email;
    role = $event.detail.role;
    is_active = $event.detail.is_active;
    deleteFormAction = '{{ route('users.index') }}/' + id;
" class="p-8">

    <div class="flex justify-between items-start mb-6 border-b border-gray-100 pb-4">
        <h2 class="text-xl font-light text-gray-900">{{ __('Edycja Użytkownika') }}</h2>

        <form :action="deleteFormAction" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-xs text-red-500 hover:text-red-700 font-medium uppercase">
                Usuń konto
            </button>
        </form>
    </div>

    <form method="POST" :action="'{{ route('users.index') }}/' + id">
        @csrf
        @method('PATCH')

        <div class="space-y-4">
            <div>
                <x-input-label value="Imię i nazwisko" />
                <x-text-input name="name" x-model="name" type="text" class="block w-full mt-1" required />
            </div>

            <div>
                <x-input-label value="Email" />
                <x-text-input name="email" x-model="email" type="email" class="block w-full mt-1" required />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label value="Rola" />
                    <select name="role" x-model="role" class="w-full mt-1 border-gray-200 rounded-lg text-sm shadow-sm">
                        <option value="employee">Pracownik</option>
                        <option value="manager">Manager</option>
                        <option value="administrator">Administrator</option>
                    </select>
                </div>
                <div class="flex items-center mt-6">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" x-model="is_active" :checked="is_active" value="1" class="rounded border-gray-300 text-indigo-600">
                        <span class="ms-2 text-sm text-gray-600">Aktywne</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-50">
                <div class="grid grid-cols-2 gap-4">
                    <x-text-input name="password" type="password" placeholder="Nowe hasło" class="text-sm" />
                    <x-text-input name="password_confirmation" type="password" placeholder="Powtórz hasło" class="text-sm" />
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-3">
            <button type="button" x-on:click="$dispatch('close-modal', 'edit-user')" class="text-sm text-gray-500">Anuluj</button>
            <x-primary-button>Zapisz zmiany</x-primary-button>
        </div>
    </form>
</div>
