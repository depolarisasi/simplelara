<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple - Find local businesses and services">
    <meta name="keywords" content="local, business, directory, services">
    <title>@yield('title') - Simple</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/media/logos/favicon.ico') }}" type="image/png">
    
    <!-- Styles -->
    @include('layouts.frontpage.styles')
    @vite('resources/css/app.css')
    @livewireStyles
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col overflow-x-hidden">
    <!-- Navbar -->
    @include('layouts.frontpage.navbar')
    
    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('layouts.frontpage.footer')
    
    <!-- Bottom Navigation -->
    @include('layouts.frontpage.bottomnav')
    
    <!-- Scripts -->
    @include('layouts.frontpage.scripts')
    @vite('resources/js/app.js')
    @yield('scripts')
    @livewireScripts
    
    <!-- Initialize icons --> 
</body>
</html>
