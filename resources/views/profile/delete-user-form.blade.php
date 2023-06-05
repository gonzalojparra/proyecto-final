<x-action-section>
    <x-slot name="title">
        <span class="text-slate-100">{{ __('Eliminar cuenta') }}</span>
    </x-slot>

    <x-slot name="description">
        <span class="text-slate-100">{{ __('Eliminar cuenta permanentemente.') }}</span>
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Una vez su cuenta sea eliminada, todos sus registros y datos serán eliminados. Antes de eliminar su cuenta, por favor descarge la información o dato que desea preservar.') }}
        </div>

        <div class="mt-5">
            <x-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Eliminar cuenta') }}
            </x-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Eliminar cuenta') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Está seguro que desea eliminar su cuenta? Una vez su cuenta sea eliminada, todos sus registros y datos serán eliminados. Por favor ingrese su contraseña para confirmar que desea eliminar su cuenta.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-input type="password" class="mt-1 block w-3/4"
                                autocomplete="current-password"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Eliminar cuenta') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
