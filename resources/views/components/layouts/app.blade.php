<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "Welcome to  RJ's KTCHN" }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')                                                              
    @livewireStyles
</head>
<body class="bg-white text-gray-900">

    @if (request()->path() == 'login' || request()->path() == 'register')
        {{ $slot }} 

    {{-- Admin Layout --}}
    @elseif (request()->is('admin*'))
        <div class="flex min-h-screen">
            <div>
                <livewire:components.sidebar />
            </div>
        <div class="ml-64 min-h-screen p-6 w-full border-2">
                {{ $slot }}
            </div>
        </div>

    {{-- Default User Layout --}}
    @else
        <livewire:components.navbar />
            <div class="min-h-screen bg-amber">
                {{ $slot }}
            </div>
        <livewire:components.footer />
    @endif

    @livewireScripts
</body>
</html>
