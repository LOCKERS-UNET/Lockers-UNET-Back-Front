<script setup lang="ts">
import { Head} from '@inertiajs/vue3';
import { ref } from 'vue';
import ModalComponent from '../Components/ModalComponent.vue';
import LayoutAdmin from '../Layouts/LayoutAdmin.vue';

defineOptions({ layout: LayoutAdmin });

// ── Estado ──
const vistaActual = ref<'modificar' | 'agregar'>('modificar');

// Modal state
const modalAbierto = ref(false);

const cambiarVista = (vista: 'modificar' | 'agregar') => {
    vistaActual.value = vista;
};

const confirmarAgregar = () => {
    // Al simular el guardado, abrimos el modal
    modalAbierto.value = true;
};
</script>

<template>
    <Head :title="vistaActual === 'modificar' ? 'Modificar Lockers' : 'Agregar Locker'" />
    <div class="min-h-screen bg-white py-12 px-4 flex justify-center">

        <!-- ─── VISTA: MODIFICAR LOCKER ─── -->
        <div v-if="vistaActual === 'modificar'" class="w-full max-w-lg flex flex-col items-center">
            
            <!-- Título y Añadir (Más llamativo) -->
            <div class="flex items-center gap-4 mb-4 mt-6">
                <h1 class="text-3xl font-extrabold text-black">Modificar Lockers</h1>
                
                <!-- Botón de Añadir muy llamativo -->
                <button 
                    @click="cambiarVista('agregar')"
                    class="bg-[#10b981] hover:bg-[#059669] text-white rounded-full p-1.5 shadow-[0_4px_10px_rgba(16,185,129,0.4)] transition-transform hover:scale-110 active:scale-95 group relative flex items-center justify-center"
                    title="Agregar Nuevo Locker"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <!-- Tooltip "Agregar Locker" flotante (opcional, le da un toque premium) -->
                    <span class="absolute -top-10 bg-gray-800 text-white text-[10px] font-bold px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
                        Agregar Locker
                    </span>
                </button>
            </div>

            <h2 class="text-lg font-extrabold text-[#4472c4] mb-12 text-center">Modificar Locker B-142</h2>

            <!-- Grid de Formulario -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-7 w-full max-w-2xl pb-10">
                
                <!-- Sector -->
                <div class="relative w-full shadow-sm rounded-full h-14 mt-[22px]">
                    <select class="w-full h-full px-6 border border-gray-200 rounded-[2rem] font-extrabold text-[15px] text-black appearance-none bg-white focus:outline-none focus:border-gray-400">
                        <option value="" disabled selected>Sector</option>
                        <option value="A">Edificio A</option>
                        <option value="B">Edificio B</option>
                        <option value="C">Edificio C</option>
                    </select>
                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-[#1a5eb8]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>

                <!-- Tamaño -->
                <div class="relative w-full shadow-sm rounded-full h-14 mt-[22px]">
                    <select class="w-full h-full px-6 border border-gray-200 rounded-[2rem] font-extrabold text-[15px] text-black appearance-none bg-white focus:outline-none focus:border-gray-400">
                        <option value="" disabled selected>Tamaño</option>
                        <option value="Pequeño">Pequeño</option>
                        <option value="Mediano">Mediano</option>
                        <option value="Grande">Grande</option>
                    </select>
                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-[#1a5eb8]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>

                <!-- Estado -->
                <div class="relative w-full shadow-sm rounded-full h-14 mt-[22px]">
                    <select class="w-full h-full px-6 border border-gray-200 rounded-[2rem] font-extrabold text-[15px] text-black appearance-none bg-white focus:outline-none focus:border-gray-400">
                        <option value="" disabled selected>Estado</option>
                        <option value="Disponible">Disponible</option>
                        <option value="Ocupado">Ocupado</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                    </select>
                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-[#1a5eb8]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>

                <!-- Código -->
                <div class="w-full flex flex-col gap-1">
                    <label class="text-sm font-extrabold text-black ml-2 mt-1">Código</label>
                    <input type="text" placeholder="Código Locker" class="w-full h-14 px-6 rounded-xl border border-gray-100 bg-[#f3f4f6] placeholder:text-gray-400 font-bold text-[15px] text-black focus:bg-white focus:outline-none focus:border-gray-300 transition-colors" />
                </div>

            </div>

            <!-- Botones -->
            <div class="w-full max-w-[280px] flex flex-col gap-4 mt-8">
                <button class="w-full py-4 bg-[#213779] hover:bg-[#1a2b5f] text-white font-extrabold rounded-xl shadow-md transition-colors active:scale-95 text-md">
                    Guardar cambios
                </button>
                <button class="w-full py-4 bg-[#f0384a] hover:bg-[#d42c3d] text-white font-extrabold rounded-xl shadow-md transition-colors active:scale-95 text-md">
                    Eliminar Locker
                </button>
            </div>

        </div>

        <!-- ─── VISTA: AGREGAR LOCKER ─── -->
        <div v-else-if="vistaActual === 'agregar'" class="w-full flex flex-col items-center max-w-2xl relative">
            
            <!-- Botón Volver (Flecha atras) opcional pero útil -->
            <button @click="cambiarVista('modificar')" class="absolute -left-10 sm:left-4 top-6 text-gray-400 hover:text-black transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </button>

            <h1 class="text-3xl sm:text-4xl font-extrabold text-black mb-12 mt-6">Agregar Locker</h1>

            <!-- Formulario de Agregar (Ensanchado y agrandado) -->
            <div class="w-full max-w-[500px] flex flex-col gap-7 mb-12">
                
                <!-- Codigo -->
                <div class="w-full flex flex-col gap-1.5">
                    <label class="text-sm font-extrabold text-black ml-4">Código</label>
                    <input type="text" placeholder="Ingrese el código del locker" class="w-full h-14 px-6 rounded-full border border-gray-200 bg-[#f9fafb] placeholder:text-gray-400 font-bold text-[15px] text-black focus:bg-white focus:outline-none focus:border-gray-400 transition-colors shadow-sm" />
                </div>

                <!-- Sector -->
                <div class="relative w-full shadow-sm rounded-full h-14">
                    <select class="w-full h-full px-6 border border-gray-200 bg-[#f9fafb] rounded-[2rem] font-bold text-[15px] text-black appearance-none focus:outline-none focus:border-gray-400 focus:bg-white sm:text-center pl-6 sm:pl-0">
                        <option value="" disabled selected>Sector</option>
                        <option value="A">Edificio A</option>
                        <option value="B">Edificio B</option>
                        <option value="C">Edificio C</option>
                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-[#213779]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>

                <!-- Piso -->
                <div class="w-full flex flex-col gap-1.5">
                    <label class="text-sm font-extrabold text-black ml-4">Piso Sector</label>
                    <input type="text" placeholder="Ingrese el piso del Sector" class="w-full h-14 px-6 sm:text-center rounded-full border border-gray-200 bg-[#f9fafb] placeholder:text-gray-400 font-bold text-[15px] text-black focus:bg-white focus:outline-none focus:border-gray-400 transition-colors shadow-sm" />
                </div>

                <!-- Tamaño -->
                <div class="relative w-full shadow-sm rounded-full h-14">
                    <select class="w-full h-full px-6 border border-gray-200 bg-[#f9fafb] rounded-[2rem] font-bold text-[15px] text-black appearance-none focus:outline-none focus:border-gray-400 focus:bg-white sm:text-center pl-6 sm:pl-0">
                        <option value="" disabled selected>Tamaño</option>
                        <option value="Pequeño">Pequeño</option>
                        <option value="Mediano">Mediano</option>
                        <option value="Grande">Grande</option>
                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-[#213779]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>

                <!-- Estado -->
                <div class="relative w-full shadow-sm rounded-full h-14">
                    <select class="w-full h-full px-6 border border-gray-200 bg-[#f9fafb] rounded-[2rem] font-bold text-[15px] text-black appearance-none focus:outline-none focus:border-gray-400 focus:bg-white sm:text-center pl-6 sm:pl-0">
                        <option value="" disabled selected>Estado</option>
                        <option value="Disponible">Disponible</option>
                        <option value="Ocupado">Ocupado</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 text-[#213779]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>

            </div>

            <!-- Boton Agregar -->
            <button 
                @click="confirmarAgregar"
                class="w-full max-w-[280px] py-4 bg-[#213779] hover:bg-[#1a2b5f] text-white font-extrabold rounded-xl shadow-md transition-colors active:scale-95 text-[15px]"
            >
                Agregar Locker
            </button>

        </div>

        <!-- Modal de confirmación -->
        <ModalComponent
            :show="modalAbierto"
            text="¡Locker agregado correctamente!"
            url="/gestion-lockers-admin"
            title-button="Volver al Panel"
            @close="modalAbierto = false; cambiarVista('modificar')"
        />

    </div>

</template>