<div >
    
  <div class="timer-container">
    <div class="timer">
      <span id="countdown">90</span>
    </div>
  </div>

  <div class="text-center">
    <!-- boton inicion -->
    <button id="btnIniciar" class="py-4 px-7 rounded bg-green-500 hover:bg-green-600 text-white border-green-700">
        <svg fill="none" class="h-6 w-6 text-white-500" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z"></path>
        </svg>
    </button>
    <!-- boton stop hover:bg-red-600  -->
    <button id="btnDetener" class="py-4 px-7 rounded bg-red-500 text-white border-red-700 " disabled>
        <svg fill="none" class="h-6 w-6 text-white-500" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5"></path>
        </svg> 
    </button>
    <!-- boton reinicio   -->
    <button id="btnReiniciar" class="py-4 px-7 rounded bg-yellow-500 hover:bg-yellow-600 text-white border-yellow-700 ">
        <svg fill="none"  class="h-6 w-6 text-white-500" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"></path>
        </svg>
    </button>
  </div>

  <!-- Tiempo dado  -->
  <div>
    <p id="contador" class="text-4xl mt-3 p-auto text-center">&nbsp;</p>
  </div>

  <script src="{{ asset('js/timer.js') }}"></script>

</div>