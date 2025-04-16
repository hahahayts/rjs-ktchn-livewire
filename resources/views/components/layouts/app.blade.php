<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body>
        @if (request()->path() == 'login' || request()->path() == 'register')
        {{ $slot }}    
        @else
        <livewire:components.navbar >
            {{ $slot }}
        <livewire:components.footer>   
        @endif

       
        @livewireScripts
       
    </body>
</html>
