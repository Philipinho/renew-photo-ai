<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
        <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

        <script defer src="https://unpkg.com/img-comparison-slider@7/dist/index.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/img-comparison-slider@7/dist/styles.css"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <livewire:styles />
    </head>
    <body class="font-sans antialiased bg-white text-gray-900 tracking-tight">
        <div class="flex flex-col min-h-screen overflow-hidden">

            @include('layouts.header')

            {{--
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            --}}

            <!-- Page Content -->
            <main class="grow">
                {{ $slot }}
            </main>
        </div>

        <livewire:scripts />
    </body>
</html>
