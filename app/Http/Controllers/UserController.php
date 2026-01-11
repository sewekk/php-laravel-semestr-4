<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->get();

        return view('users.list', compact('users'));
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'is_active' => true,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('users.index')
            ->with('status', 'user-created');
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        if (auth()->user()->isManager() && !auth()->user()->isAdmin()) {
            if (!empty($validated['password'])) {
                $user->update([
                    'password' => Hash::make($validated['password'])
                ]);
                return redirect()->route('users.index')->with('status', 'Hasło pracownika zostało zmienione.');
            }
            return back()->withErrors(['error' => 'Jako Manager możesz zmieniać tylko hasła pracowników.']);
        }

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'is_active' => $request->has('is_active'),
        ]);

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')->with('status', 'Dane użytkownika zostały zaktualizowane.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->withErrors(['error' => 'Nie możesz usunąć własnego konta.']);
        }

        $user->delete();
        return redirect()->route('users.index')->with('status', 'user-deleted');
    }
}
