<x-app-layout>
  <div class="container mx-auto">
    <div class="flex justify-center">
      <form id="formulario" action="{{ route('competidores.store') }}" method="POST" class="border m-2 p-3 fs-5 bg-white sm:w-1/2 lg:w-1/3">
        <h1 class="text-2xl font-bold mb-4">Inscribir Competidor</h1>
        @csrf

        <!-- DNI -->
        <div class="mb-3">
          <label for="du" class="block mb-1">DU</label>
          <input type="text" class="form-input w-full" id="du" name="du" />
        </div>
        <!-- Nombre competidor -->
        <div class="mb-3">
          <label for="nombre" class="block mb-1">Nombre</label>
          <input type="text" class="form-input w-full" id="nombre" name="nombre" />
        </div>

        <!-- Apellido Competidor -->
        <div class="mb-3">
          <label for="apellido" class="block mb-1">Apellido</label>
          <input type="text" class="form-input w-full" id="apellido" name="apellido" />
        </div>

        <!-- Nacimiento -->
        <div class="mb-3">
          <label for="fecha-nacimiento" class="block mb-1">Fecha de nacimiento</label>
          <input type="date" class="form-input w-full" id="fecha-nacimiento" name="fecha-nacimiento" min="1960-01-01" />
        </div>

        <!-- Pais -->
        <div class="mb-3">
          <label for="pais" class="block mb-1">País de origen</label>
          <input class="form-input w-full" id="pais" name="pais" />
          <div id="autocomplete-suggestions" class="autocomplete-suggestions"></div>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <label for="email" class="block mb-1">Email de contacto</label>
          <input type="email" class="form-input w-full" id="email" name="email" />
        </div>

        <!-- Genero -->
        <div class="mb-3">
          <label class="block mb-1">Género</label>
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
        </div>

        <!-- GAL: Primary Key -->
        <div class="mb-3">
          <label for="gal" class="block mb-1">GAL</label>
          <input type="text" class="form-input w-full" id="gal" name="gal" placeholder="Ej: ABC1234567" />
        </div>

        <!-- Graduacion -->
        <div class="mb-3">
          <label for="graduacion" class="block mb-1">Graduación</label>
          <select class="form-select" id="graduacion" name="graduacion">
            <option value="">Seleccione una graduación</option>
            <option value="1ro GUP">1ro GUP</option>
            <option value="2do GUP">2do GUP</option>
            <option value="3ro GUP">3ro GUP</option>
            <option value="4to GUP">4to GUP</option>
            <option value="5to GUP">5to GUP</option>
            <option value="6to GUP">6to GUP</option>
            <option value="7mo GUP">7mo GUP</option>
            <option value="8vo GUP">8vo GUP</option>
            <option value="9no GUP">9no GUP</option>
            <option value="10mo GUP">10mo GUP</option>
            <option value="1er DAN">1er DAN</option>
            <option value="2do DAN">2do DAN</option>
            <option value="3er DAN">3er DAN</option>
            <option value="4to DAN">4to DAN</option>
            <option value="5to DAN">5to DAN</option>
            <option value="6to DAN">6to DAN</option>
            <option value="7mo DAN">7mo DAN</option>
            <option value="8vo DAN">8vo DAN</option>
            <option value="9no DAN">9no DAN</option>
          </select>
        </div>

        <!-- Clasificacion en el ranking -->
        <div class="mb-3">
          <label for="clasificacion" class="block mb-1">Clasificación general del ranking nacional</label>
          <input type="text" class="form-input w-full" id="clasificacion" name="clasificacion" placeholder="Ingrese su posición en el ranking nacional" pattern="^\S+$" required />
        </div>
        <!-- Agrega el campo _token manualmente -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="mb-3">
          <input type="submit" value="Registrar" class="bg-[#070830] text-[white] border rounded py-2 px-4">
        </div>
      </form>
    </div>


    <!-- Mensajes de Error de js-->
    <div id="envio" class="alert alert-danger mt-3" style="display:none;" role="alert"></div>

    <!-- Mensajes de error de la bd -->
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#du').on('blur', function() {
        var valor = $(this).val();
        var columnName = 'du';

        console.log(valor);
        $.ajax({
          url: "{{route('competidores.find')}}",
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
  </script>
</x-app-layout>

<script src="../js/validarForm2.js" type="module"></script>