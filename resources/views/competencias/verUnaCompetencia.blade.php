<x-app-layout>

    <div class="info-competencia mt-6 mb-8">
        <div>
            <h1 class="text-6xl flex justify-center font-semibold dark:text-gray-400 ">Competencia re dificil wacho</h1>
        </div>
        <div class="datos-competencia gap-x-2 flex flex-row justify-center mt-6">
            <div class="flyer max-w-sm mr-4">
                <img src="https://img.pikbest.com/backgrounds/20190415/taekwondo-competition-background-image_1811499.jpg!w700wp">
            </div>
            <div class="flex flex-col">
                <div class="data dark:text-gray-400 mb-2" style="height: 80%;">
                    <ul>
                        <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2">
                            <h1 class="text-lg font-semibold">Lugar</h1>
                            Polideportivo Manuel Belgrano
                        </li>
                        <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                            <h1 class="text-lg font-semibold">Fecha apertura</h1>
                            23/06/2023
                        </li>
                        <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                            <h1 class="text-lg font-semibold">Fecha cierre</h1>
                            26/06/2023
                        </li>
                        <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                            <h1 class="text-lg font-semibold">Horario</h1>
                            08:00 - 16:30
                        </li>
                        <li class="dark:bg-gray-800 dark:border-gray-700 rounded-md max-w-md p-2 mt-4">
                            <h1 class="text-lg font-semibold">Descripción</h1>
                            Ta complicadísima wacho, no se anoten D:
                        </li>
                    </ul>
                </div>
                <div class="flex flex-row justify-center items-end mt-8 text-gray-500 ml-5" style="height: 20%;">
                    <div grid justify-items-center>

                            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Inscripción
                                </span>
                            </button>
                            

                            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Bases y condiciones
                                </span>
                            </button>

                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="resultados-competencia" style="margin-top: 5rem;">
        <div class="">
            <h1 class="text-6xl flex justify-center font-semibold dark:text-gray-400">Resultados</h1>
        </div>
        @livewire('competidores.tabla-competidores')
    </div>
</div>

    
<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                <form class="space-y-6" action="#">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</x-app-layout>