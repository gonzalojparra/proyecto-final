<x-app-layout>

    @section('title', 'Zen Kicks')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenidos') }}
        </h2>
    </x-slot>

    
    @livewire('home.home')
    
</x-app-layout>