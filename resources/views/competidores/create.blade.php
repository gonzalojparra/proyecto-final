<x-app-layout>
  <link rel="stylesheet" type="text/css" href="{{ asset('jqueryui/jquery-ui.min.css') }}">
  <div class="container mx-auto flex">
    <div class="bg-white m-4 p-3">
      <p>Colegio Actual: {{ $escuela->name }}</p>
      <p>GAL: {{  $competidor->gal  }}</p>
      <p>Graduacion: {{ $competidor->graduacion }}</p>
    </div>
    <div class="flex justify-center">
      <form id="formulario" action="{{ route('competidores.store') }}" method="POST" class="border m-2 p-3 fs-5 bg-white">
        <h1 class="text-2xl font-bold mb-4">Informacion de competidor</h1>
        @csrf

        

        <!-- Escuela -->
        <div class="mb-3">
          <label for="escuela" class="block mb-1">Escuela(*)</label>
          <input class="form-input w-full" id="escuela" name="escuela" value="{{ $escuela->name }}"/>
          <div id="autocomplete-suggestions" class="autocomplete-suggestions"></div>
        </div>

        <!-- GAL: Primary Key -->
        <div class="mb-3">
          <label for="gal" class="block mb-1">GAL(*)</label>
          <input type="text" class="form-input w-full" id="gal" name="gal" placeholder="Ej: ABC1234567" value="{{ $competidor->gal }}" />
        </div>

        <!-- Graduacion -->
        <div class="mb-3">
          @php
          $graduaciones = [
          '1ro GUP',
          '2do GUP',
          '3ro GUP',
          '4to GUP',
          '5to GUP',
          '6to GUP',
          '7mo GUP',
          '8vo GUP',
          '9no GUP',
          '10mo GUP',
          '1ro DAN',
          '2do DAN',
          '3ro DAN',
          '4to DAN',
          '5to DAN',
          '6to DAN',
          '7mo DAN',
          '8vo DAN',
          '9no DAN',
          ];
          @endphp

          <label for="graduacion" class="block mb-1">Graduación(*)</label>
          <select class="form-select" id="graduacion" name="graduacion">
            <option value="">Seleccione una graduación</option>
            @foreach ($graduaciones as $graduacion)
            <option value="{{ $graduacion }}" {{ $competidor->graduacion === $graduacion ? 'selected' : '' }}>
              {{ $graduacion }}
            </option>
            @endforeach
          </select>
          <label for="comentario" class="block mb-1 mt-2">Comentario</label>
          <input class="form-input w-full" type="text" name="Comentario" id="comentario">
        </div>

        <!-- Clasificacion en el ranking -->
        <!-- <div class="mb-3">
          <label for="clasificacion" class="block mb-1">Clasificación general del ranking nacional(*)</label>
          <input type="text" class="form-input w-full" id="clasificacion" name="clasificacion" placeholder="Ingrese su posición en el ranking nacional" pattern="^\S+$" required />
        </div> -->
        <!-- Agrega el campo _token manualmente -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="mb-3">
          <input type="submit" value="Pedir actualización" class="bg-[#070830] text-[white] border rounded py-2 px-4">
        </div>
      </form>
    </div>

    <!-- Mensajes de Error de js-->
    <div id="envio" class="alert alert-danger mt-3" style="display:none;" role="alert"></div>

    <!-- Mensajes de error de la bd -->
  </div>
  
</x-app-layout>

<script src="../js/validarForm2.js" type="module"></script>


<!-- DNI -->
        <!-- <div class="mb-3">
          <label for="du" class="block mb-1">DU(*)</label>
          <input type="text" class="form-input w-full" id="du" name="du" />
        </div> -->
        <!-- Nombre competidor -->
        <!-- <div class="mb-3">
          <label for="nombre" class="block mb-1">Nombre(*)</label>
          <input type="text" class="form-input w-full" id="nombre" name="nombre" />
        </div> -->

        <!-- Apellido Competidor -->
        <!-- <div class="mb-3">
          <label for="apellido" class="block mb-1">Apellido(*)</label>
          <input type="text" class="form-input w-full" id="apellido" name="apellido" />
        </div> -->

        <!-- Nacimiento -->
        <!-- <div class="mb-3">
          <label for="fecha-nacimiento" class="block mb-1">Fecha de nacimiento(*)</label>
          <input type="date" class="form-input w-full" id="fecha-nacimiento" name="fecha-nacimiento" min="1960-01-01" />
        </div> -->
        <!-- Pais -->
        <!-- <div class="mb-3">
          <label for="pais" class="block mb-1">País de origen(*)</label>
          <input class="form-input w-full" id="pais" name="pais" />
          <div id="autocomplete-suggestions" class="autocomplete-suggestions"></div>
        </div> -->

        <!-- Categoria -->
        <!-- <div class="mb-3">
          <label for="categoria" class="block mb-1">Categoria(*)</label>
          <input class="form-input w-full" id="categoria" name="categoria" />
          <div id="autocomplete-suggestions" class="autocomplete-suggestions"></div>
        </div> -->
        <!-- Email -->
        <!-- <div class="mb-3">
          <label for="email" class="block mb-1">Email de contacto(*)</label>
          <input type="email" class="form-input w-full" id="email" name="email" />
        </div> -->

        <!-- Genero -->
        <!-- <div class="mb-3">
          <label class="block mb-1">Género(*)</label>
          <div>
            <label for="femenino" class="inline-flex items-center mr-4">
              <input class="form-radio" type="radio" name="genero" id="femenino" value="Femenino" />
              <span class="ml-2">Femenino</span>
            </label>
            <label for="masculino" class="inline-flex items-center">
              <input class="form-radio" type="radio" name="genero" id="masculino" value="Masculino" />
              <span class="ml-2">Masculino</span>
            </label>
          </div>
        </div> -->