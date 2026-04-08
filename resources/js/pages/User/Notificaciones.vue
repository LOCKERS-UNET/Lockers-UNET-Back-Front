<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue';

defineOptions({ layout: Layout });

// ── Datos mockeados para coincidir con el diseño ──
const notificaciones = [
    {
        id: 1,
        titulo: 'Pago de Arancel',
        fecha: '13-05-2026',
    },
    {
        id: 2,
        titulo: 'Pago de Arancel',
        fecha: '13-05-2026',
    },
    {
        id: 3,
        titulo: 'Pago de Arancel',
        fecha: '13-05-2026',
    }
];
</script>

<template>
    <Head title="Notificaciones" />
    <div class="flex flex-col items-center min-h-screen py-12 px-4 bg-white">

        <section class="w-full max-w-2xl flex flex-col items-center gap-6">

            <!-- Título Principal -->
            <h1 class="text-3xl font-extrabold text-black">Notificaciones</h1>

            <!-- Buscador -->
            <div class="w-full max-w-md relative mt-2 mb-6">
                <!-- Ícono de Lupa -->
                <div class="absolute inset-y-0 left-4 flex items-center justify-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-gray-500">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <!-- Input estilizado como píldora -->
                <input 
                    type="text" 
                    placeholder="Buscar notificación" 
                    class="w-full py-3 pl-12 pr-6 border border-gray-300 rounded-[2rem] text-sm text-center outline-none focus:border-gray-400 focus:ring-0 shadow-sm placeholder:text-center placeholder:text-gray-400"
                />
            </div>

            <!-- Contenedor alineado a la izquierda para los items -->
            <div class="w-full max-w-[500px] text-left">
                <!-- Subtítulo -->
                <h2 class="text-md sm:text-lg font-extrabold text-black mb-4">Visualizacion notificaciones</h2>

                <!-- Lista de notificaciones -->
                <div class="flex flex-col gap-4">
                    <div 
                        v-for="n in notificaciones" 
                        :key="n.id" 
                        class="bg-[#e5e7eb] p-6 w-full flex flex-col gap-2 rounded-md"
                    >
                        <p class="font-extrabold text-black">{{ n.titulo }}</p>
                        <p class="text-black text-sm">Tu proxima fecha es {{ n.fecha }}</p>
                    </div>
                </div>
            </div>

        </section>
    </div>
</template>