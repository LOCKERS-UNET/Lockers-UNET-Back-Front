<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue';

defineOptions({ layout: Layout });
</script>

<template>
    <Head title="Pago Arancel" />
    <div class="flex flex-col items-center min-h-screen py-10 px-4 bg-white relative">
        <section class="w-full max-w-xl flex flex-col items-center mt-6">
            
            <h1 class="text-3xl font-extrabold text-black mb-10">Pago Arancel</h1>
            
            <!-- Tarjeta Central -->
            <div class="bg-white px-10 py-10 w-full max-w-[400px] mb-12 flex flex-col items-center gap-4 shadow-[0_0px_20px_rgba(0,0,0,0.06)] border border-gray-100 rounded-sm">
                <p class="text-gray-600 text-lg"><span class="font-extrabold text-black">Monto:</span> Bs. 5000</p>
                <p class="text-gray-600 text-lg"><span class="font-extrabold text-black">Motivo:</span> Pago Atrasado</p>
            </div>

            <!-- Direccion Section -->
            <div class="w-full max-w-[400px] flex flex-col mb-16 px-4">
                
                <!-- Header con línea a la derecha -->
                <div class="flex items-center w-full mb-6 gap-4">
                    <h3 class="text-xl font-black text-[#213779]">Dirección</h3>
                    <div class="flex-1 h-px bg-gray-400 mt-1"></div>
                </div>
                
                <p class="font-extrabold text-black text-center text-sm mb-6 px-4">Decanato de Desarrollo Estudiantil.</p>
                
                <div class="h-px bg-gray-400 w-full mb-8"></div>
                
                <!-- Horario -->
                <div class="flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" class="w-7 h-7">
                      <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-gray-500 font-bold text-lg">8:00am - 2:00pm</span>
                </div>
            </div>

            <Link href="/" class="bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold py-3 px-16 rounded-[1rem] shadow-md transition-colors text-lg">
                Entendido
            </Link>

        </section>
    </div>
</template>
