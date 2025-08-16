<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-16">
        <section class="w-full">
            @include('partials.settings-heading')

            <x-settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">
                <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                    <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
                    <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
                    <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
                </flux:radio.group>
            </x-settings.layout>
        </section>
    </div>
</div>
@endsection
