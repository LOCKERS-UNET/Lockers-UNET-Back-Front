<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import Layout from '../Layouts/Layout.vue';

    defineOptions({ layout: Layout });

    // ── Datos mockeados (en producción vendrían del backend via defineProps) ──
    const locker = {
        id: 142,
        codigo: 'B-142',
        edificio: 'B',
        piso: 1,
        tamano: 'Mediano',
        estado: 'Activo',
        fechaAsignacion: '10/01/2026',
        arancel: {
            estado: 'Pendiente',   // 'Al Día' | 'Pendiente'
            monto: 'Bs. 50.00',
            periodo: 'Ene – Jun 2026',
            vencimiento: '15/04/2026',
        },
    };

    // Si no tiene locker asignado, se muestra la pantalla vacía
    const tieneLocker = true;
</script>

<template>
    <div class="flex flex-col items-center min-h-screen py-8 px-4">

        <section class="w-full max-w-3xl flex flex-col gap-8">

            <h1 class="text-2xl font-bold lg:text-3xl text-center">Mi Locker</h1>

            <!-- ──── Con locker asignado ──── -->
            <template v-if="tieneLocker">

                <!-- Tarjeta principal del locker -->
                <div class="bg-white rounded-2xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.1)] p-6 flex flex-col sm:flex-row gap-6 items-center">

                    <!-- Ícono grande -->
                    <div class="shrink-0 bg-[#EBF0FA] rounded-2xl p-5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#213779" class="size-16">
                            <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Info del locker -->
                    <div class="flex flex-col gap-3 w-full">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-black text-[#213779]">{{ locker.codigo }}</h2>
                            <span class="bg-[#D1FAE5] text-[#0D7A5F] text-xs font-bold px-3 py-1 rounded-full">
                                {{ locker.estado }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <p class="text-gray-500">Edificio <span class="font-bold text-gray-800">{{ locker.edificio }}</span></p>
                            <p class="text-gray-500">Piso <span class="font-bold text-gray-800">{{ locker.piso }}</span></p>
                            <p class="text-gray-500">Tamaño <span class="font-bold text-gray-800">{{ locker.tamano }}</span></p>
                            <p class="text-gray-500">Desde <span class="font-bold text-gray-800">{{ locker.fechaAsignacion }}</span></p>
                        </div>
                    </div>

                </div>

                <!-- Tarjeta de arancel -->
                <div class="bg-white rounded-2xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.1)] p-6">

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-[#4169C4]">Estado del Arancel</h3>
                        <span :class="[
                            'text-xs font-bold px-3 py-1 rounded-full',
                            locker.arancel.estado === 'Al Día'
                                ? 'bg-[#D1FAE5] text-[#0D7A5F]'
                                : 'bg-[#FEE2E2] text-[#DC2626]'
                        ]">
                            {{ locker.arancel.estado }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm">
                        <div class="flex flex-col gap-1">
                            <p class="text-gray-400 font-semibold">Monto</p>
                            <p class="font-black text-gray-800 text-lg">{{ locker.arancel.monto }}</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-gray-400 font-semibold">Período</p>
                            <p class="font-bold text-gray-800">{{ locker.arancel.periodo }}</p>
                        </div>
                        <div class="flex flex-col gap-1">
                            <p class="text-gray-400 font-semibold">Vencimiento</p>
                            <p class="font-bold text-gray-800">{{ locker.arancel.vencimiento }}</p>
                        </div>
                    </div>

                    <div v-if="locker.arancel.estado === 'Pendiente'" class="mt-4">
                        <Link
                            href="/pago-arancel"
                            class="inline-flex items-center gap-2 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold
                                   px-6 py-2 rounded-xl transition duration-300 active:scale-95 text-sm"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                            </svg>
                            Pagar Arancel
                        </Link>
                    </div>

                </div>

                <!-- Botón reporte de incidencia -->
                <div class="flex justify-center">
                    <Link
                        href="/reportes-user"
                        class="inline-flex items-center gap-2 border-2 border-[#DC2626] text-[#DC2626]
                               hover:bg-[#DC2626] hover:text-white font-bold px-6 py-2 rounded-xl
                               transition duration-300 active:scale-95 text-sm"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd" d="M3 2.25a.75.75 0 0 1 .75.75v.54l1.838-.46a9.75 9.75 0 0 1 6.725.738l.108.054A8.25 8.25 0 0 0 18 4.524l3.11-.732a.75.75 0 0 1 .917.81 47.784 47.784 0 0 0 .005 10.337.75.75 0 0 1-.574.812l-3.114.733a9.75 9.75 0 0 1-6.594-.77l-.108-.054a8.25 8.25 0 0 0-5.69-.625l-2.202.55V21a.75.75 0 0 1-1.5 0V3A.75.75 0 0 1 3 2.25Z" clip-rule="evenodd" />
                        </svg>
                        Reportar Incidencia
                    </Link>
                </div>

            </template>

            <!-- ──── Sin locker asignado ──── -->
            <template v-else>
                <div class="flex flex-col items-center justify-center py-16 gap-6 text-gray-400">
                    <div class="bg-gray-100 rounded-full p-8">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#A3A3A3" class="size-16">
                            <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-center">
                        <p class="font-bold text-lg text-gray-700">No tienes un locker asignado</p>
                        <p class="text-sm mt-1">Solicita uno desde la lista de casilleros disponibles.</p>
                    </div>
                    <Link
                        href="/buscar-locker"
                        class="bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold px-6 py-3 rounded-xl
                               transition duration-300 active:scale-95"
                    >
                        Buscar Locker
                    </Link>
                </div>
            </template>

        </section>
    </div>
</template>