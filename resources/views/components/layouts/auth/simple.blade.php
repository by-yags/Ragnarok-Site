<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="flex min-h-screen">
            <div class="hidden bg-left bg-cover bg-center md:block md:w-1/4"></div>
            <div class="flex w-full flex-col items-center justify-center gap-6 bg-background p-6 md:w-1/2 md:p-10">
                <div class="flex w-full max-w-sm flex-col gap-2">
                    <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                        <span class="mb-1 flex h-9 w-9 items-center justify-center rounded-md">
                            <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                        </span>
                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                    <div class="flex flex-col gap-6">
                        {{ $slot }}
                    </div>
                </div>
            </div>
            <div class="hidden bg-right bg-cover bg-center md:block md:w-1/4"></div>
        </div>
        @fluxScripts
    </body>
</html>
