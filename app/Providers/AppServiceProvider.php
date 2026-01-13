<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('manage-users', fn (User $user) => $user->canManageUsers());

        Gate::define('view-all-requests', fn (User $user) => in_array($user->role, ['administrator', 'manager']));

        Gate::define('decide-on-request', fn (User $user) => $user->role === 'manager');

        Gate::define('create-leave-request', fn (User $user) => in_array($user->role, ['employee', 'manager']));

        Gate::define('add-work-time', fn (User $user) => $user->role === 'employee');

        Gate::define('view-all-work-times', fn (User $user) => in_array($user->role, ['administrator', 'manager']));

        Gate::define('manage-work-times', fn (User $user) => $user->role === 'manager');

        Gate::define('view-work-times', fn (User $user) => in_array($user->role, ['administrator', 'manager', 'employee']));
    }
}
