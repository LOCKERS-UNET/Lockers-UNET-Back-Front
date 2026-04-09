<script setup lang="ts">
import { Link, Head } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue';

defineOptions({ layout: Layout });

// ── Datos mockeados (en producción vendrían del backend via defineProps) ──
const locker = {
    codigo: 'B-142',
    estado: 'En uso',
    fechaFin: '13/05/2026',
    pagoPendiente: 'Bs. 3500'
};
</script>

<template>
    <Head title="Mi Locker" />
    <div class="flex flex-col items-center min-h-screen py-10 px-4 bg-white relative">

        <section class="w-full max-w-lg flex flex-col items-center mt-6">
            
            <!-- Título -->
            <h1 class="text-3xl font-extrabold text-black mb-8">Mi Locker</h1>
            
            <!-- Subtítulo Código Locker -->
            <h2 class="text-4xl font-bold text-[#4472c4] mb-8">Locker: {{ locker.codigo }}</h2>

            <!-- Tarjeta Central -->
            <div class="bg-white rounded-md shadow-[0px_4px_15px_rgba(0,0,0,0.1)] border border-gray-100 p-8 w-full max-w-sm mb-10 flex flex-col gap-6 text-center">
                <p class="text-gray-800 text-md"><span class="font-bold text-black">Estado:</span> {{ locker.estado }}</p>
                <p class="text-gray-800 text-md"><span class="font-bold text-black">Fecha Fin:</span> {{ locker.fechaFin }}</p>
                <p class="text-gray-800 text-md"><span class="font-bold text-black">Pago Pendiente:</span> {{ locker.pagoPendiente }}</p>
            </div>

            <!-- Botones de Acción -->
            <div class="flex flex-col w-full max-w-sm gap-4">
                
                <Link href="/pago-arancel" class="flex items-center justify-between bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold py-4 px-6 rounded-xl transition-colors shadow-md">
                    <span class="ml-2">Pago Arancel</span>
                    <!-- Icono Moneda -->
                    <div class="bg-white rounded-full p-[2px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#213779" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </Link>

                <Link href="#" class="flex items-center justify-between bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold py-4 px-6 rounded-xl transition-colors shadow-md">
                    <span class="ml-2">Multas</span>
                    <!-- Icono Alerta Seguro -->
                    <div class="bg-white rounded-full p-[2px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#213779" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </Link>

                <Link href="#" class="flex items-center justify-between bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold py-4 px-6 rounded-xl transition-colors shadow-md">
                    <span class="ml-2">Devolucion Locker</span>
                    <!-- Icono Descarga/Devolucion -->
                    <div class="bg-white rounded-full p-[2px] flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#213779" class="w-5 h-5">
                            <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </Link>
                
            </div>
        </section>
    </div>
</template>