<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Titulo de pestañas - logo  -->
    <title>@yield('title','PWA')</title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/2534/2534518.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <!-- <link rel="stylesheet" href="{{ asset('css/estilosLayout.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/timer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/easterEgg.css') }}">


</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-1/2 bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts



    <footer class="bg-white m-2">
        <div class="w-full max-w-screen-xl mx-auto p-2 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">

                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="#" class="mr-4 hover:underline md:mr-6 ">About</a>
                    </li>
                    <li>
                        <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="mr-4 hover:underline md:mr-6 ">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>

                <ul class="wrapper">
                    <li class="icon vicky">
                        <span class="tooltip">Vicky</span>
                        <span><i class="fab fa-facebook-f"></i></span>
                    </li>
                    <li class="icon gonza">
                        <span class="tooltip">Gonza</span>
                        <span><i class="fab fa-twitter"></i></span>
                    </li>
                    <li class="icon lau">
                        <span class="tooltip">Laureano</span>
                        <span><i class="fab fa-instagram"></i></span>
                    </li>
                    <li class="icon lucas">
                        <span class="tooltip">Lucas</span>
                        <span><i class="fab fa-facebook-f"></i></span>
                    </li>
                    <li class="icon marti">
                        <span class="tooltip">Marti</span>
                        <span><i class="fab fa-twitter"></i></span>
                    </li>
                    <li class="icon jero">
                        <span class="tooltip">Jero</span>
                        <span><i class="fab fa-instagram"></i></span>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <a target="_blank" href="https://github.com/gonzalojparra/proyecto-final"><span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 Grupo A.</span></a>
        </div>
    </footer>

    <script src="{{ asset('jquery-3.7.0.min.js') }}" type="text/javascript"></script>
    @include('popper::assets')
</body>

</html>