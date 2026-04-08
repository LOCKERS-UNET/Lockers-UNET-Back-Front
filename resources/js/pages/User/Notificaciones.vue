<script setup lang="ts">
    import Layout from '../Layouts/Layout.vue';

    defineOptions({ layout: Layout });

    // ── Tipos ──────────────────────────────────────────────────────────────
    interface Notificacion {
        id: number;
        tipo: 'info' | 'alerta' | 'exito' | 'multa';
        titulo: string;
        descripcion: string;
        fecha: string;
        leida: boolean;
    }

    // ── Datos mockeados ────────────────────────────────────────────────────
    const notificaciones: Notificacion[] = [
        {
            id: 1,
            tipo: 'exito',
            titulo: 'Solicitud Aprobada',
            descripcion: 'Tu solicitud del locker B-142 fue aprobada. ¡Ya puedes usarlo!',
            fecha: '07/04/2026',
            leida: false,
        },
        {
            id: 2,
            tipo: 'multa',
            titulo: 'Nueva Multa Registrada',
            descripcion: 'Se registró una multa por devolución tardía del locker.',
            fecha: '05/04/2026',
            leida: false,
        },
        {
            id: 3,
            tipo: 'info',
            titulo: 'Recordatorio de Arancel',
            descripcion: 'Tu arancel del período Ene–Jun 2026 vence el 15/04/2026.',
            fecha: '03/04/2026',
            leida: true,
        },
        {
            id: 4,
            tipo: 'alerta',
            titulo: 'Mantenimiento Programado',
            descripcion: 'El edificio A estará cerrado el 10/04/2026 por mantenimiento.',
            fecha: '01/04/2026',
            leida: true,
        },
    ];

    // ── Helpers de estilo ───────────────────────────────────────────────────
    const iconColor = (tipo: string) => {
        if (tipo === 'exito')  return '#0D7A5F';
        if (tipo === 'multa')  return '#DC2626';
        if (tipo === 'alerta') return '#F97316';
        return '#213779';
    };

    const borderColor = (tipo: string) => {
        if (tipo === 'exito')  return 'border-l-[#0D7A5F]';
        if (tipo === 'multa')  return 'border-l-[#DC2626]';
        if (tipo === 'alerta') return 'border-l-[#F97316]';
        return 'border-l-[#213779]';
    };
</script>

<template>
    <div class="flex flex-col items-center min-h-screen py-8 px-4">

        <section class="w-full max-w-3xl flex flex-col gap-6">

            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold lg:text-3xl">Notificaciones</h1>
                <span class="bg-[#213779] text-white text-xs font-bold px-3 py-1 rounded-full">
                    {{ notificaciones.filter(n => !n.leida).length }} nuevas
                </span>
            </div>

            <!-- Lista -->
            <div v-if="notificaciones.length > 0" class="flex flex-col gap-4">

                <div
                    v-for="n in notificaciones"
                    :key="n.id"
                    :class="[
                        'flex flex-row gap-4 items-start bg-white rounded-xl p-4 border-l-4 shadow-[0px_4px_23px_0px_rgba(0,0,0,0.08)] transition',
                        borderColor(n.tipo),
                        !n.leida ? 'ring-1 ring-[#213779]/20' : 'opacity-70'
                    ]"
                >
                    <!-- Ícono -->
                    <div class="shrink-0 mt-1">
                        <!-- Éxito -->
                        <svg v-if="n.tipo === 'exito'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#0D7A5F" class="size-7">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                        </svg>
                        <!-- Multa -->
                        <svg v-else-if="n.tipo === 'multa'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#DC2626" class="size-7">
                            <path fill-rule="evenodd" d="M11.484 2.17a.75.75 0 0 1 1.032 0 11.209 11.209 0 0 0 7.877 3.08.75.75 0 0 1 .722.515 12.74 12.74 0 0 1 .635 3.985c0 5.942-4.064 10.933-9.563 12.348a.749.749 0 0 1-.374 0C6.314 20.683 2.25 15.692 2.25 9.75c0-1.39.223-2.73.635-3.985a.75.75 0 0 1 .722-.516l.143.001c2.996 0 5.718-1.17 7.734-3.08ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75ZM12 15a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75H12Z" clip-rule="evenodd" />
                        </svg>
                        <!-- Alerta -->
                        <svg v-else-if="n.tipo === 'alerta'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#F97316" class="size-7">
                            <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>
                        <!-- Info -->
                        <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#213779" class="size-7">
                            <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5A.75.75 0 0 0 12 9Z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Contenido -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <p class="font-bold text-sm sm:text-base text-gray-800">{{ n.titulo }}</p>
                            <span v-if="!n.leida"
                                  class="shrink-0 w-2 h-2 rounded-full bg-[#213779] mt-2">
                            </span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">{{ n.descripcion }}</p>
                        <p class="text-xs text-gray-400 mt-2">{{ n.fecha }}</p>
                    </div>

                </div>

            </div>

            <!-- Sin notificaciones -->
            <div v-else class="flex flex-col items-center justify-center py-20 gap-4 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-16">
                    <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z" clip-rule="evenodd" />
                </svg>
                <p class="font-semibold text-lg">No tienes notificaciones</p>
            </div>

        </section>
    </div>
</template>