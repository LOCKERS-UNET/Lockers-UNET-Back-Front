<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Layout from '../Layouts/Layout.vue';

defineOptions({ layout: Layout });
</script>

<template>
    <Head title="Mis Solicitudes" />
    <div class="flex flex-col items-center min-h-screen py-10 px-4 bg-white">
        
        <section class="w-full max-w-lg flex flex-col items-center mt-6">
            
            <!-- Título Principal -->
            <h1 class="text-3xl font-extrabold text-black mb-14">Mis Solicitudes</h1>
            
            <!-- Tarjeta Simple Gris -->
            <div class="bg-[#e5e7eb] px-10 py-8 w-full max-w-[380px] mb-32 flex flex-col gap-4 rounded-sm">
                <h2 class="text-2xl font-extrabold text-black">Locker #142</h2>
                <p class="text-black text-md">Estado solicitud: Aprobado</p>
            </div>

            <!-- Boton Inferior -->
            <Link href="/" class="bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold py-4 px-12 rounded-xl shadow-md transition-colors text-sm">
                Volver al Menú
            </Link>

        </section>
        
    </div>
</template>