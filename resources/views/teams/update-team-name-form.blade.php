<x-form-section submit="updateTeamName">
    <x-slot name="title" class="text-white">
        <span class="text-slate-100">{{ __('Nombre de la escuela') }}</span>
    </x-slot>

    <x-slot name="description" class="text-white">
        <span class="text-slate-100">{{ __('Información del dueño de la escuela.') }}</span>
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-label value="{{ __('Team Owner') }}" />

            <div class="flex items-center mt-2">
                

                <div class="ml-4 leading-tight">
                    <div class="text-gray-900">{{ $team->owner->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Team Name') }}" />

            <x-input id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model.defer="state.name"
                        :disabled="! Gate::check('update', $team)"
                        readonly />

            <x-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('Guardado.') }}
            </x-action-message>

            <x-button>
                {{ __('Guardar') }}
            </x-button>
        </x-slot>
    @endif
</x-form-section>
