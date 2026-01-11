<section class="p-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Złóż nowy wniosek urlopowy') }}
        </h2>
    </header>

    <form method="post" action="{{ route('leave-requests.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="start_date" :value="__('Data rozpoczęcia')" />
            <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date')" required />
            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="end_date" :value="__('Data zakończenia')" />
            <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date')" required />
            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Wyślij wniosek') }}
            </x-primary-button>

            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Anuluj') }}
            </x-secondary-button>
        </div>
    </form>
</section>
