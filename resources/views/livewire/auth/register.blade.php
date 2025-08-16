<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Volt\Component;

new class extends Component {
    public string $first_name = '';
    public string $last_name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $agree_to_terms = false;
    public bool $captcha_completed = false;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'agree_to_terms' => ['accepted'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        // Combine first and last name to 'name' for the User model
        $validated['name'] = $this->first_name . ' ' . $this->last_name;

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg mt-16">
        <div class="flex flex-col gap-6 auth-container">
            <x-auth-header :title="__('Begin Your Legend')" :description="__('Inscribe your name in the annals of history.')" />

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form method="POST" wire:submit="register" class="flex flex-col gap-6">
                <!-- First Name -->
                <flux:input
                    wire:model="first_name"
                    :label="__('First Name')"
                    type="text"
                    required
                    autofocus
                    autocomplete="given-name"
                    placeholder="Your given name..."
                />

                <!-- Last Name -->
                <flux:input
                    wire:model="last_name"
                    :label="__('Last Name')"
                    type="text"
                    required
                    autocomplete="family-name"
                    placeholder="Your family name..."
                />

                <!-- Username -->
                <flux:input
                    wire:model="username"
                    :label="__('Rune Knight Name')"
                    type="text"
                    required
                    autocomplete="username"
                    placeholder="Enter your Rune Knight name..."
                />

                <!-- Email Address -->
                <flux:input
                    wire:model="email"
                    :label="__('Scroll of Identity (Email)')"
                    type="email"
                    required
                    autocomplete="email"
                    placeholder="Your magical email address..."
                />

                <!-- Password -->
                <flux:input
                    wire:model="password"
                    :label="__('Secret Rune (Password)')"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Your secret rune..."
                    viewable
                />

                <!-- Confirm Password -->
                <flux:input
                    wire:model="password_confirmation"
                    :label="__('Confirm Secret Rune')"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="Confirm your secret rune..."
                    viewable
                />

                <!-- Terms and Conditions -->
                <flux:checkbox wire:model="agree_to_terms" :label="__('I agree to the Terms and Conditions')" />

                <!-- Captcha Placeholder -->
                <div class="flex items-center gap-4">
                    <div class="w-full h-16 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500 dark:text-gray-400">Captcha Placeholder</span>
                    </div>
                    <flux:checkbox wire:model="captcha_completed" :label="__('Completed')" />
                </div>


                <div class="flex items-center justify-end">
                    <flux:button type="submit" variant="primary" class="w-full" wire:loading.attr="disabled" :disabled="!$agree_to_terms || !$captcha_completed">
                        {{ __('Forge My Legend') }}
                    </flux:button>
                </div>
            </form>

            <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                <span>{{ __('Already have a legend?') }}</span>
                <flux:link :href="route('login')" wire:navigate>{{ __('Re-enter the Gates') }}</flux:link>
            </div>
        </div>
    </div>
</div>
@endsection
