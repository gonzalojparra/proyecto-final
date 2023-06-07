<x-app-layout>
@section('title', 'Temporizador')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Temporizador') }}
        </h2>
    </x-slot>

    <div class="p-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl sm:rounded-lg p-5">
                <x-timer/>
            </div>
        </div>
    </div>
</x-app-layout>