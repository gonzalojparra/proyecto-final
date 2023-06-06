<x-app-layout>
    
@section('title', 'Zen Kicks')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenidos') }}
        </h2>
    </x-slot>

    <!-- <div class="p-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5"> -->
                @livewire('home.home')
            <!-- </div>
        </div>
    </div> -->
</x-app-layout>
