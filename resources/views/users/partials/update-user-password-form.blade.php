<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Reset hasła</h2>
        <p class="mt-1 text-sm text-gray-600">Ustaw nowe hasło dla pracownika.</p>
    </header>

    <form method="post" action="{{ route('users.password.update', $user) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="password" value="Nowe hasło" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Potwierdź hasło" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Zmień hasło</x-primary-button>
        </div>
    </form>
</section>
