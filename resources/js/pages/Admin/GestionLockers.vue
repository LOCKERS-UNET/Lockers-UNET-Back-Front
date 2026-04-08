<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import LayoutAdmin from '../Layouts/LayoutAdmin.vue';

defineOptions({ layout: LayoutAdmin });
</script>

<template>
    <Head title="Modificar Lockers" />
    <div class="min-h-screen bg-white py-12 px-4 flex justify-center">

        <div class="w-full max-w-lg flex flex-col items-center">
            
            <!-- Título y Añadir -->
            <div class="flex items-center gap-3 mb-4 mt-6">
                <!-- Para respetar los pesos visuales de Figma -->
                <h1 class="text-3xl font-extrabold text-black">Modificar Lockers</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-gray-800 cursor-pointer hover:scale-105 active:scale-95 transition-all">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>

            <h2 class="text-lg font-extrabold text-[#4472c4] mb-12 text-center">Modificar Locker B-142</h2>

            <!-- Grid de Formulario -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6 w-full max-w-xl pb-10">
                
                <!-- Sector -->
                <div class="relative w-full shadow-sm rounded-full h-12 mt-[22px]">
                    <select class="w-full h-full px-6 border border-gray-200 rounded-[2rem] font-extrabold text-sm text-black appearance-none bg-white focus:outline-none focus:border-gray-400">
                        <option>Sector</option>
                    </select>
                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-[#1a5eb8]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>

                <!-- Tamaño -->
                <div class="relative w-full shadow-sm rounded-full h-12 mt-[22px]">
                    <select class="w-full h-full px-6 border border-gray-200 rounded-[2rem] font-extrabold text-sm text-black appearance-none bg-white focus:outline-none focus:border-gray-400">
                        <option>Tamaño</option>
                    </select>
                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-[#1a5eb8]">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>

                <!-- Estado -->
                <div class="relative w-full shadow-sm rounded-full h-12 mt-[22px]">
                    <select class="w-full h-full px-6 border border-gray-200 rounded-[2rem] font-extrabold text-sm text-black appearance-none bg-white focus:outline-none focus:border-gray-400">
                        <option>Estado</option>
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
                    <input type="text" placeholder="Código Locker" class="w-full h-12 px-5 rounded-xl border border-gray-100 bg-[#f3f4f6] placeholder:text-gray-400 font-bold text-sm text-black focus:bg-white focus:outline-none focus:border-gray-300 transition-colors" />
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

    </div>
</template>