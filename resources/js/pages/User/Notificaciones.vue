<script setup lang="ts">
import { ref, computed } from 'vue'; // Importamos ref y computed
import { Head } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue';

defineOptions({ layout: Layout });

// 1. Estado para el texto de búsqueda
const search = ref('');

// 2. Datos (en producción vendrían de props)
const notificaciones = [
    {
        id: 1,
        titulo: 'Pago de Arancel',
        fecha: '13-05-2026',
    },
    {
        id: 2,
        titulo: 'Mantenimiento Preventivo',
        fecha: '20-05-2026',
    },
    {
        id: 3,
        titulo: 'Multa Pendiente',
        fecha: '15-06-2026',
    }
];

// 3. Lógica de filtrado
const notificacionesFiltradas = computed(() => {
    // Si no hay nada escrito, devolvemos todas
    if (!search.value) return notificaciones;

    // Convertimos a minúsculas para que la búsqueda no sea sensible a mayúsculas
    const query = search.value.toLowerCase();

    return notificaciones.filter(n => {
        return n.titulo.toLowerCase().includes(query) || 
               n.fecha.toLowerCase().includes(query);
    });
});
</script>

<template>
    <Head title="Notificaciones" />
    <div class="flex flex-col items-center min-h-screen py-12 px-4 bg-white">

        <section class="w-full max-w-2xl flex flex-col items-center gap-6">

            <h1 class="text-3xl font-extrabold text-black">Notificaciones</h1>

            <div class="w-full max-w-md relative mt-2 mb-6">
                <div class="absolute inset-y-0 left-4 flex items-center justify-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-gray-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <input 
                    v-model="search"
                    type="text" 
                    placeholder="Buscar notificación" 
                    class="w-full py-3 pl-12 pr-6 border border-gray-300 rounded-[2rem] text-sm text-center outline-none focus:border-gray-400 focus:ring-0 shadow-sm placeholder:text-center placeholder:text-gray-400"
                    aria-label="Buscar notificaciones por título o fecha"
                />
            </div>

            <div class="w-full max-w-[500px] text-left">
                <h2 class="text-md sm:text-lg font-extrabold text-black mb-4">Visualización notificaciones</h2>

                <div class="flex flex-col gap-4">
                    <template v-if="notificacionesFiltradas.length > 0">
                        <div 
                            v-for="n in notificacionesFiltradas" 
                            :key="n.id" 
                            class="bg-[#e5e7eb] p-6 w-full flex flex-col gap-2 rounded-md transition-all duration-300"
                        >
                            <p class="font-extrabold text-black">{{ n.titulo }}</p>
                            <p class="text-black text-sm">Tu próxima fecha es {{ n.fecha }}</p>
                        </div>
                    </template>

                    <div v-else class="text-center py-10 opacity-60">
                        <p class="font-bold text-gray-500">No se encontraron notificaciones que coincidan con "{{ search }}"</p>
                    </div>
                </div>
            </div>

        </section>
    </div>
</template>