<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
    @if (!empty($competencias))
           <x-nav-link href="{{ route('timer') }}" :active="request()->routeIs('timer')">
        {{ __('Iniciar Competencia') }}
    </x-nav-link>
    @endif
    
</div>