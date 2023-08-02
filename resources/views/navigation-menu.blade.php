<nav class="w-full" x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('index') }}">
                        <x-logo class="block h-auto w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('resultados') }}" :active="request()->routeIs('resultados')">
                        {{ __('Ranking') }}
                    </x-nav-link>
                </div>

                @role('Admin|Competidor|Juez')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('competencias.index') }}" :active="request()->routeIs('competencias')">
                        {{ __('Competencias') }}
                    </x-nav-link>
                </div>
                @endrole

                {{-- @role('Admin')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('solicitudes-registro') }}" :active="request()->routeIs('roles')">
                {{ __('Usuarios') }}
                </x-nav-link>
            </div>
            @endrole --}}

            @role('Admin')
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">

                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                <span class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    {{ __('Administrar') }}
                                </span>
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('solicitudes-registro') }}" :active="request()->routeIs('roles')">
                                {{ __('Peticiones') }}
                            </x-dropdown-link>

                            <div class="border-t border-gray-200">
                                @role('Admin')
                                <x-dropdown-link href="{{ route('competencias.administrar-competencias') }}" :active="request()->routeIs('competencias')">
                                    {{ __('Competencias') }}
                                </x-dropdown-link>
                                @endrole
                            </div>

                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            @endrole
        </div>
        @if (Auth::check())
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <!-- Teams Dropdown -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures() && Auth::user()->current_team_id)
            <div class="ml-3 relative">
                <x-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button disabled type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                <!-- {{ Auth::user()->currentTeam->name }} -->
                                <!-- <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                    </svg> -->
                            </button>
                        </span>
                    </x-slot>

                    <x-slot name="content">
                        <div class="w-60">
                            <!-- Team Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Administrar escuela') }}
                            </div>

                            <!-- Team Settings -->
                            <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Información de escuela') }}
                            </x-dropdown-link>

                            <!-- Team Switcher -->
                            @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Cambiar de escuela') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" />
                            @endforeach
                            @endif
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
            @endif

            <!-- Settings Dropdown -->
            <div class="ml-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                        @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ Auth::user()->name }}

                                @if( Auth::user()->verificado == 0 )
                                | CUENTA NO VERIFICADA
                                @endif

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Administrar cuenta') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Perfil') }}
                        </x-dropdown-link>
                        <!-- <x-dropdown-link href="{{ route('competidores.create') }}">
                                {{ __('Informacion Competidor') }}
                            </x-dropdown-link> -->

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Salir') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
        @else
        @if (Route::has('login'))
        <div class="sm:flex sm:top-0 sm:right-0 p-5 text-right z-10">
            @auth
            <a href="{{ url('/index') }}" class="font-semibold text-gray-600 hover:text-gray-900  focus:rounded-sm focus:outline-red-500">Home</a>
            @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900   focus:rounded-sm">Ingresar</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:rounded-sm">Registrarse</a>
            @endif
            @endauth
        </div>
        @endif

        @endif


        <!-- Hamburger -->
        <div class="-mr-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('index') }}" :active="request()->routeIs('index')">
                {{ __('Home') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('resultados') }}" :active="request()->routeIs('resultados')">
                {{ __('Ranking') }}
            </x-responsive-nav-link>
        </div>
        @role('Admin|Competidor|Juez')
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('competencias.index') }}" :active="request()->routeIs('competencias')">
                {{ __('Competencias') }}
            </x-responsive-nav-link>
        </div>
        @endrole
        <!-- <div class="pt-2 pb-3 space-y-1">
            <div class="pt-2 pb-3 space-y-1">
                <x-dropdown align="right" width="45">
                    <x-slot name="trigger">

                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                            <span class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                {{ __('Administrar') }}
                            </span>
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-responsive-nav-link href="{{ route('solicitudes-registro') }}" :active="request()->routeIs('roles')">
                            {{ __('Peticiones') }}
                        </x-responsive-nav-link>

                        <div class="border-t border-gray-200">
                            @role('Admin')
                            <x-responsive-nav-link href="{{ route('competencias.administrar-competencias') }}" :active="request()->routeIs('competencias')">
                                {{ __('Competencias') }}
                            </x-responsive-nav-link>
                            @endrole
                        </div>

                    </x-slot>
                </x-dropdown>
            </div>
        </div> -->
        @if(Auth::check())
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 mr-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
                @endif
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Salir') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures() && Auth::user()->current_team_id)
                <div class="border-t border-gray-200"></div>

                <!-- <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Administrar escuela') }}
                </div> -->

                <!-- Team Settings -->

                <!-- Team Switcher -->
                @if (Auth::user()->allTeams()->count() > 1)
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Cambiar escuela') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                <x-switchable-team :team="$team" component="responsive-nav-link" />
                @endforeach
                @endif
                @endif
            </div>
        </div>
        @endif
    </div>
</nav>