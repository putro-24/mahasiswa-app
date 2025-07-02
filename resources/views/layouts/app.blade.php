<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white min-h-screen">
            <div class="p-6 text-xl font-bold border-b border-gray-700">
                <a href="{{ route('dashboard') }}" class="text-white hover:underline">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <nav class="p-4 space-y-2 text-sm">
                <a href="{{ route('dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('mahasiswa.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Mahasiswa</a>
                <a href="{{ route('jurusan.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Jurusan</a>
                <a href="{{ route('prodi.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Program Studi</a>
                <a href="{{ route('dosen.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Dosen</a>
                <a href="{{ route('pengajuan.index') }}" class="block py-2 px-3 rounded hover:bg-gray-700">Pengajuan SKPI</a>

                @auth
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full text-left py-2 px-3 rounded hover:bg-red-700 bg-red-600">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-2 px-3 mt-4 rounded hover:bg-blue-700 bg-blue-600">Login</a>
                @endauth
            </nav>
        </aside>

        <!-- Content Area -->
        <div class="flex-1 p-6">

            <!-- Page Header -->
            @isset($header)
                <header class="bg-white shadow mb-6">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Main Content -->
            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="text-center text-sm text-gray-500 mt-12 border-t pt-4">
                Powered by <a href="https://templated.co/" class="underline" target="_blank">TEMPLATED</a>,
                distributed by <a href="https://themewagon.com/" class="underline" target="_blank">ThemeWagon</a>.
