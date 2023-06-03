<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administrar Roles') }}
        </h2>
    </x-slot>

    <div class='max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8'>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="px-6 py-3 flex justify-between al ">
                <x-input class="w-25" wire:model='filtro' type='text' />
                @livewire('roles.create')     
            </div>

<<<<<<< Updated upstream
            @if ($usuarios->count()>0)
=======
            @if (count($usuariosPendientes) > 0)
>>>>>>> Stashed changes
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">

                <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            <span class="cursor-pointer">
<<<<<<< Updated upstream
                                Nombre
=======
                                ID
>>>>>>> Stashed changes
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="cursor-pointer">
<<<<<<< Updated upstream
                                apellido
=======
                                Nombre
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="cursor-pointer">
                                Apellido Competidor
>>>>>>> Stashed changes
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="cursor-pointer">
                                Correo
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="cursor-pointer">
<<<<<<< Updated upstream
                                Rol Solicitado
=======
                                Rol solicitado
                            </span>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="cursor-pointer">
                                Estado de cuenta
>>>>>>> Stashed changes
                            </span>
                        </th>

                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">EDITAR</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
<<<<<<< Updated upstream
                    @foreach ($usuarios as $usuario )
=======
                    @foreach ($usuariosPendientes as $usuario )
>>>>>>> Stashed changes
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$usuario->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{$usuario->name}}
                        </td>
                        <td class="px-6 py-4">
                            {{$usuario->apellido}}
                        </td>
                        <td class="px-6 py-4">
                            {{$usuario->email}}
                        </td>
                        <td class="px-6 py-4">
<<<<<<< Updated upstream
                            {{$usuario->name}}
=======
                            {{$usuario->rol}}
                        </td>
                        <td class="px-6 py-4">
                            @if($usuario->verificado == 0)
                            No habilitado
                            @else
                            Habilitado
                            @endif
>>>>>>> Stashed changes
                        </td>
                        
                        <td class="px-6 py-4">
<<<<<<< Updated upstream
                           
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="mostrarCompetidor({{$usuario->id}})" >Ver Perfil</a>
=======
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" wire:click="mostrarCompetidor({{$usuario->id}})">Ver Perfil</a>
>>>>>>> Stashed changes
                        </td>
                    </tr>

                    @endforeach


                </tbody>
            </table>
            @else
            <div class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 px-6 py-3 text-dark">
                <h3>
                    No se encuentran solicitudes
                </h3>
            </div>

            @endif
        </div>
    </div>
</div>