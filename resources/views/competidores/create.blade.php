<x-app-layout>
  <link rel="stylesheet" type="text/css" href="{{ asset('jqueryui/jquery-ui.min.css') }}">
  <div class="container mx-auto">
    <div class="flex justify-center">
      <form id="formulario" action="{{ route('competidores.store') }}" method="POST" class="border m-2 p-3 fs-5 bg-white sm:w-3/4 lg:w-2/3">
        <h1 class="text-2xl font-bold mb-4">Informacion de competidor</h1>
        @csrf

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

        <!-- Colegio -->
        <div class="mb-3">
          <label for="colegio" class="block mb-1">Colegio(*)</label>
          <input class="form-input w-full" id="colegio" name="colegio" />
          <div id="autocomplete-suggestions" class="autocomplete-suggestions"></div>
        </div>

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

        <!-- Colegio -->
        <div class="mb-3">
          <label for="colegio" class="block mb-1">Colegio(*)</label>
          <input class="form-input w-full" id="colegio" name="colegio" value="{{ $escuela->name }}"/>
          <div id="autocomplete-suggestions" class="autocomplete-suggestions"></div>
        </div>

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <!--  <script src="{{ asset('jquery-3.7.0.min.js') }}" type="text/javascript"></script> -->
  <script src="{{ asset('jqueryui/jquery-ui.min.js') }}" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      $('#du').on('blur', function() {
        var valor = $(this).val();
        var columnName = 'du';

        console.log(valor);
        $.ajax({
          url: "{{route('competidores.buscarCompetidor')}}",
          method: 'POST',
          dataType: "json",
          data: {
            _token: $('#formulario').find('input[name="_token"]').val(),
            du: valor, // Cambiado de 'valor' a 'du'
            columnName: columnName,
          },
          success: function(response) {
            // Aquí puedes manipular los resultados obtenidos
            console.log(response);
            let data = response[0]; // Acceder al primer elemento del arreglo
            $('#nombre').val(data.nombre);
            $('#apellido').val(data.apellido);
            $('#fecha_nacimiento').val(data.fecha_nac);
            $('#pais').val(data.pais_nombre);
            $('#email').val(data.email);
            $('input[name="genero"][value="' + data.genero + '"]').prop('checked', true); // Establecer opción seleccionada del input de tipo radio
            $('#gal').val(data.legajo);
            $('#graduacion').val(data.graduacion);
            $('#clasificacion').val(data.clasificacion);
            $('#apellido').val(data.apellido);
          },
          error: function(xhr) {
            // Manejo de errores
            console.log(xhr.responseText);
          }
        });

      });
    });

    $(document).ready(function() {

      $("#pais").autocomplete({
        source: function(request, response) {
          // Fetch data
          $.ajax({
            url: "{{route('competidores.buscarPaises')}}",
            type: 'post',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            data: {
              search: request.term
            },
            success: function(data) {
              response(data);
            }
          });
        },
        select: function(event, ui) {
          // Set selection
          $('#pais').val(ui.item.label); // display the selected text
          // $('#employeeid').val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });

    $(document).ready(function() {

      $("#colegio").autocomplete({
        source: function(request, response) {
          // Fetch data
          $.ajax({
            url: "{{route('competidores.buscarColegio')}}",
            type: 'post',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            data: {
              search: request.term
            },
            success: function(data) {
              response(data);
            }
          });
        },
        select: function(event, ui) {
          // Set selection
          $('#colegio').val(ui.item.label); // display the selected text
          // $('#employeeid').val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });
  </script>
</x-app-layout>

<script src="../js/validarForm2.js" type="module"></script>