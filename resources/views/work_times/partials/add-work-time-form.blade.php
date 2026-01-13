<section class="p-8">
    <header class="border-b border-gray-100 pb-4 mb-6">
        <h2 class="text-xl font-light text-gray-900">{{ __('Dodaj przepracowany czas') }}</h2>
    </header>

    <form method="post" action="{{ route('work-times.store') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="start_at" :value="__('Data i godzina rozpoczęcia')" />
            <input
                id="start_at"
                name="start_at"
                type="datetime-local"
                step="60"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required
            />
            <x-input-error :messages="$errors->get('start_at')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="end_at" :value="__('Data i godzina zakończenia')" />
            <input
                id="end_at"
                name="end_at"
                type="datetime-local"
                step="60"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required
            />
            <x-input-error :messages="$errors->get('end_at')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end gap-4 pt-4">
            <button type="button" x-on:click="$dispatch('close-modal', 'add-work-time')" class="text-sm text-gray-500 font-medium">
                {{ __('Anuluj') }}
            </button>
            <x-primary-button>
                {{ __('Wyślij do akceptacji') }}
            </x-primary-button>
        </div>
    </form>
</section>
