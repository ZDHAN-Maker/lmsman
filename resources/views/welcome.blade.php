<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIAKAD</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body class="font-sans antialiased min-h-screen flex flex-col text-gray-900">

    <!-- Header -->
    <header class="w-full py-6 px-8 shadow-md dark:bg-gray-800" >
        <div class="mx-auto flex max-w-7xl items-center justify-between">
            <!-- Logo atau Judul -->
            <div class="text-xl font-semibold text-white">
                SIAKAD MAN 2 KOTA JAMBI
            </div>

            <!-- Navigasi -->
            @if (Route::has('login'))
            <nav class="flex items-center space-x-4">
                @guest
                <a href="{{ route('login') }}"
                    class="rounded-md px-4 py-2 text-white ring-1 ring-transparent transition hover:bg-white hover:text-black focus:outline-none focus-visible:ring-[#FF2D20]">
                    Login
                </a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="rounded-md px-4 py-2 text-white ring-1 ring-transparent transition hover:bg-white hover:text-black focus:outline-none focus-visible:ring-[#FF2D20]">
                    Register
                </a>
                @endif

                @else
                <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-4 py-2 text-white ring-1 ring-transparent transition hover:bg-white hover:text-black focus:outline-none focus-visible:ring-[#FF2D20]">
                    Dashboard
                </a>
                @endguest
            </nav>
            @endif
        </div>
    </header>

    <!-- Main content -->
    <main class="relative flex-1 flex items-center justify-center z-10 text-gray-900">
        <div class="text-center text-3xl font-bold text-black ">
            Selamat Datang di SIAKAD MAN 2 KOTA JAMBI
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full py-6 text-center text-sm text-white shadow-inner dark:bg-gray-800" >
        SIAKAD MAN 2 KOTA JAMBI
    </footer>

</body>

</html>