<div class="p-8">
    <h2 class="text-xl font-light text-gray-900 border-b border-gray-100 pb-4 mb-6">
        {{ __('Nowy Użytkownik') }}
    </h2>

    <form method="post" action="{{ route('users.store') }}">
        @csrf

        <div class="space-y-5">
            <div>
                <x-input-label for="name" value="Imię i nazwisko" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full border-gray-200" :value="old('name')" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full border-gray-200" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="role" value="Rola" />
                <select name="role" class="mt-1 block w-full border-gray-200 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm py-2.5">
                    <option value="employee">Pracownik</option>
                    <option value="manager">Manager</option>
                    <option value="administrator">Administrator</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-input-label for="password" value="Hasło" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full border-gray-200" required />
                </div>
                <div>
                    <x-input-label for="password_confirmation" value="Potwierdź" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full border-gray-200" required />
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end space-x-3">
            <button type="button" x-on:click="$dispatch('close-modal', 'add-user')" class="text-sm text-gray-500 hover:text-gray-700 transition font-medium">
                Anuluj
            </button>
            <x-primary-button>
                Zapisz pracownika
            </x-primary-button>
        </div>
    </form>
</div>
