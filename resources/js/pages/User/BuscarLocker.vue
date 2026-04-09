<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
// import ModalComponent from '../Components/ModalComponent.vue';
import Layout from '../Layouts/Layout.vue';

defineOptions({ layout: Layout });

// ── Tipos ──────────────────────────────────────────────────────────────
interface Locker {
    id: number;
    codigo: string;
    sector: string;
    tamano: string;
    estado: string;
}

// ── Datos mockeados (Base de datos ficticia) ──
const lockersBase: Locker[] = [
    { id: 1, codigo: 'B-141', sector: 'B', tamano: 'Pequeño', estado: 'Disponible' },
    { id: 2, codigo: 'B-142', sector: 'B', tamano: 'Mediano', estado: 'Disponible' },
    { id: 3, codigo: 'B-143', sector: 'B', tamano: 'Grande', estado: 'Ocupado' },
    { id: 4, codigo: 'A-101', sector: 'A', tamano: 'Pequeño', estado: 'Mantenimiento' },
    { id: 5, codigo: 'A-102', sector: 'A', tamano: 'Mediano', estado: 'Disponible' },
    { id: 6, codigo: 'C-201', sector: 'C', tamano: 'Grande', estado: 'Disponible' },
];

// ── Filtros Reactivos ──
const filtroSector = ref<string>('');
const filtroTamano = ref<string>('');
const filtroEstado = ref<string>('');

const irASolicitud = (locker: Locker) => {
    router.get('/solicitud-locker', {
        id: locker.id,
        codigo: locker.codigo,
        tamano: locker.tamano,
        // Asignamos el edificio/piso basado en el sector para que coincida con la imagen
        edificio: `Edificio ${locker.sector} - Piso 1` 
    });
};

// Lógica Computada para ejecutar el filtro
const lockersFiltrados = computed(() => {
    return lockersBase.filter(locker => {
        // Si el filtro está vacío (""), dejar pasar. Si tiene algo, comparar.
        const matchSector = filtroSector.value === '' || locker.sector === filtroSector.value;
        const matchTamano = filtroTamano.value === '' || locker.tamano === filtroTamano.value;
        const matchEstado = filtroEstado.value === '' || locker.estado === filtroEstado.value;

        return matchSector && matchTamano && matchEstado;
    });
});

// Opciones únicas extraídas de los datos (para rellenar los selects)
const sectosDisponibles = [...new Set(lockersBase.map(l => l.sector))];
const tamanosDisponibles = ['Pequeño', 'Mediano', 'Grande'];
const estadosDisponibles = ['Disponible', 'Ocupado', 'Mantenimiento'];

</script>

<template>
    <Head title="Buscar Locker" />
    <div class="min-h-screen bg-white py-12 px-4 flex justify-center">

        <div class="w-full max-w-4xl flex flex-col items-center">
            
            <div class="w-full border-[5px] border-[#1da1f2] rounded-md p-6 sm:p-12 flex flex-col items-center">
                
                <h1 class="text-2xl sm:text-3xl font-extrabold text-black mb-8">Búsqueda de Lockers</h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 w-full max-w-2xl mb-12">
                    
                    <div class="relative w-full shadow-sm rounded-full">
                        <select v-model="filtroSector" class="w-full h-12 px-6 border border-gray-200 rounded-[2rem] font-bold text-sm text-black appearance-none bg-white focus:outline-none focus:border-gray-400">
                            <option value="">Sector (Todos)</option>
                            <option v-for="sec in sectosDisponibles" :key="sec" :value="sec">Edificio {{ sec }}</option>
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-black">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>

                    <div class="relative w-full shadow-sm rounded-full">
                        <select v-model="filtroTamano" class="w-full h-12 px-6 border border-gray-200 rounded-[2rem] font-bold text-sm text-black appearance-none bg-white focus:outline-none focus:border-gray-400">
                            <option value="">Tamaño (Todos)</option>
                            <option v-for="tam in tamanosDisponibles" :key="tam" :value="tam">{{ tam }}</option>
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-black">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>

                    <div class="relative w-full shadow-sm rounded-full">
                        <select v-model="filtroEstado" class="w-full h-12 px-6 border border-gray-200 rounded-[2rem] font-bold text-sm text-black appearance-none bg-white focus:outline-none focus:border-gray-400">
                            <option value="">Estado (Todos)</option>
                            <option v-for="est in estadosDisponibles" :key="est" :value="est">{{ est }}</option>
                        </select>
                        <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-black">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>

                    <div class="w-full h-12 px-6 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold text-sm rounded-[2rem] flex items-center justify-between shadow-md transition-colors pointer-events-none">
                        <span class="pl-2">Filtrar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                          <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 0 1 .628.74v2.288a2.25 2.25 0 0 1-.659 1.59l-4.682 4.683a2.25 2.25 0 0 0-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 0 1 8 18.25v-5.757a2.25 2.25 0 0 0-.659-1.591L2.659 6.22A2.25 2.25 0 0 1 2 4.629V2.34a.75.75 0 0 1 .628-.74Z" clip-rule="evenodd" />
                        </svg>
                    </div>

                </div>

                <div class="w-full max-w-3xl flex flex-col">
                    
                    <template v-if="lockersFiltrados.length > 0">
                        <div v-for="(locker, idx) in lockersFiltrados" :key="locker.id" class="w-full">
                            <div v-if="idx > 0" class="h-px bg-gray-300 w-full my-6"></div>
                            <div v-if="idx === 0" class="h-px bg-gray-300 w-full mb-6"></div>

                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="flex flex-col gap-1 w-full sm:w-1/3 text-center sm:text-left">
                                    <p class="text-sm sm:text-base text-black"><span class="font-extrabold text-black">Locker:</span> {{ locker.codigo }}</p>
                                    <p class="text-sm sm:text-base text-black"><span class="font-extrabold text-black">Tamaño:</span> {{ locker.tamano }}</p>
                                </div>
                                
                                <div class="w-full sm:w-1/3 flex justify-center">
                                    <span :class="[
                                        'font-extrabold text-sm sm:text-base tracking-wide',
                                        locker.estado === 'Disponible' ? 'text-[#0D7A5F]' : (locker.estado === 'Ocupado' ? 'text-[#DC2626]' : 'text-orange-500')
                                    ]">
                                        {{ locker.estado }}
                                    </span>
                                </div>

                                <div class="w-full sm:w-1/3 flex justify-center sm:justify-end">
                                    <button 
                                        v-if="locker.estado === 'Disponible'" 
                                        @click="irASolicitud(locker)"
                                        class="bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold py-2 px-8 rounded-xl shadow-md transition duration-300 active:scale-95 text-sm"
                                    >
                                        Solicitar
                                    </button>
                                    <p v-else class="text-gray-400 font-bold py-2 text-sm italic">
                                        No Disponible
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>
                    
                    <template v-else>
                        <div class="py-12 flex flex-col items-center justify-center opacity-50">
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10 mb-4 text-gray-400">
                                <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                            </svg>
                            <p class="font-bold text-gray-500">Ningún locker coincide con los filtros</p>
                        </div>
                    </template>
                </div>

            </div>
            
            <div class="flex gap-2 justify-center mt-6">
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                <div class="w-4 h-2 rounded-full bg-gray-400"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                <div class="w-2 h-2 rounded-full bg-gray-300"></div>
            </div>
        </div>
    </div>
</template>