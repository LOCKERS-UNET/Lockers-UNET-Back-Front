<template>
  <Head title="Reporte de Incidencias" />

  <!-- Nota: Si usas un Layout (como tu barra de navegación superior), asegúrate de que este archivo lo está usando correctamente -->
  <div class="min-h-screen bg-white pb-10">
    <div class="max-w-3xl mx-auto pt-12 px-4 sm:px-6 lg:px-8">
      
      <!-- Título Principal -->
      <h1 class="text-3xl font-extrabold text-center text-black mb-10">
        Reporte de Incidencias
      </h1>

      <!-- Formulario -->
      <form @submit.prevent="submitReport" class="space-y-6 max-w-lg mx-auto">
        
        <!-- Campo: Codigo -->
        <div>
          <label class="block text-sm font-bold text-gray-800 mb-2">Codigo</label>
          <input 
            v-model="form.codigo"
            type="text" 
            placeholder="Ingresa el código del locker"
            class="w-full bg-gray-100 border-none rounded-lg p-3 text-gray-700 outline-none focus:ring-2 focus:ring-[#1a3668] transition-shadow"
            required
          />
        </div>

        <!-- Campo: ID -->
        <div>
          <label class="block text-sm font-bold text-gray-800 mb-2">ID</label>
          <input 
            v-model="form.id_locker"
            type="text" 
            placeholder="Ingresa el ID del locker"
            class="w-full bg-gray-100 border-none rounded-lg p-3 text-gray-700 outline-none focus:ring-2 focus:ring-[#1a3668] transition-shadow"
            required
          />
        </div>

        <!-- Campo: Sector -->
        <div>
          <label class="block text-sm font-bold text-gray-800 mb-2">Sector (Edificio-Piso)</label>
          <input 
            v-model="form.sector"
            type="text" 
            placeholder="Ingresa el ID del locker"
            class="w-full bg-gray-100 border-none rounded-lg p-3 text-gray-700 outline-none focus:ring-2 focus:ring-[#1a3668] transition-shadow"
            required
          />
        </div>

        <!-- Campo: Input Usuario (Textarea) -->
        <div>
          <label class="block text-sm font-bold text-gray-800 mb-2">Input Usuario</label>
          <textarea 
            v-model="form.descripcion"
            placeholder="Placeholder"
            rows="5"
            class="w-full bg-gray-100 border-none rounded-lg p-3 text-gray-700 outline-none focus:ring-2 focus:ring-[#1a3668] resize-none transition-shadow"
            required
          ></textarea>
        </div>

        <!-- Botón de Envío -->
        <div class="text-center pt-6">
          <button 
            type="submit"
            class="bg-[#1a3668] hover:bg-[#12264a] text-white font-bold py-3 px-12 rounded-xl transition-colors duration-300 shadow-md"
          >
            Enviar Reporte
          </button>
        </div>

      </form>
    </div>

    <!-- Modal de Éxito -->
    <ModalComponent
      :show="showModal"
      text="Reporte enviado con éxito"
      titleButton="Aceptar"
      url="/"
      @close="showModal = false"
    />
  </div>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
import ModalComponent from '../Components/ModalComponent.vue';
import Layout from '../Layouts/Layout.vue';

defineOptions({ layout: Layout });

// Variable donde Vue almacena los datos de tu formulario
const form = reactive({
  codigo: '',
  id_locker: '',
  sector: '',
  descripcion: ''
});

// Control del Modal
const showModal = ref(false);

// Función que se dispara al dar clic al botón azul
const submitReport = () => {
    console.log("Intento de envío de reporte:", form);
    // En lugar del alert feo, prendemos el Modal de Figma
    showModal.value = true;
};
</script>
