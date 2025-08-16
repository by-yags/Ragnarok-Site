<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg mt-16">
        <div class="flex flex-col gap-6">
            <x-auth-header
                :title="__('Confirm password')"
                :description="__('This is a secure area of the application. Please confirm your password before continuing.')"
            />

            <!-- Session Status -->
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form method="POST" wire:submit="confirmPassword" class="flex flex-col gap-6">
                <!-- Password -->
                <flux:input
                    wire:model="password"
                    :label="__('Password')"
                    type="password"
                    required
                    autocomplete="new-password"
                    :placeholder="__('Password')"
                    viewable
                />

                <flux:button variant="primary" type="submit" class="w-full">{{ __('Confirm') }}</flux:button>
            </form>
        </div>
    </div>
</div>
@endsection
