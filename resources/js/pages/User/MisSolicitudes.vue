<script setup lang="ts">
    import Layout from '../Layouts/Layout.vue';

    defineOptions({ layout: Layout });

    // ── Tipos ──────────────────────────────────────────────────────────────
    interface Solicitud {
        id: number;
        locker: string;
        edificio: string;
        tamano: string;
        fecha: string;
        estado: 'Pendiente' | 'Aprobada' | 'Rechazada';
        motivo?: string;
    }

    // ── Datos mockeados ────────────────────────────────────────────────────
    const solicitudes: Solicitud[] = [
        {
            id: 1,
            locker: 'B-142',
            edificio: 'B',
            tamano: 'Mediano',
            fecha: '07/04/2026',
            estado: 'Pendiente',
        },
        {
            id: 2,
            locker: 'A-103',
            edificio: 'A',
            tamano: 'Grande',
            fecha: '01/03/2026',
            estado: 'Aprobada',
        },
        {
            id: 3,
            locker: 'C-101',
            edificio: 'C',
            tamano: 'Pequeño',
            fecha: '10/02/2026',
            estado: 'Rechazada',
            motivo: 'Locker ya asignado a otro estudiante.',
        },
    ];

    // ── Helpers ─────────────────────────────────────────────────────────────
    const estadoClases = (estado: string) => {
        if (estado === 'Aprobada')  return 'bg-[#D1FAE5] text-[#0D7A5F]';
        if (estado === 'Rechazada') return 'bg-[#FEE2E2] text-[#DC2626]';
        return 'bg-[#EBF0FA] text-[#213779]';
    };

    const estadoIcono = (estado: string) => estado;
</script>

<template>
    <div class="flex flex-col items-center min-h-screen py-8 px-4">

        <section class="w-full max-w-3xl flex flex-col gap-6">

            <h1 class="text-2xl font-bold lg:text-3xl text-center">Mis Solicitudes</h1>

            <!-- Lista de solicitudes -->
            <div v-if="solicitudes.length > 0" class="flex flex-col gap-4">

                <div
                    v-for="s in solicitudes"
                    :key="s.id"
                    class="bg-white rounded-2xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.08)] p-5 flex flex-col sm:flex-row
                           sm:items-center gap-4 transition hover:shadow-md"
                >
                    <!-- Ícono locker -->
                    <div class="shrink-0 bg-[#EBF0FA] rounded-xl p-3 self-start sm:self-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#213779" class="size-8">
                            <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 flex flex-col gap-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <p class="font-black text-[#213779] text-lg">{{ s.locker }}</p>
                            <span :class="['text-xs font-bold px-2 py-0.5 rounded-full', estadoClases(s.estado)]">
                                {{ s.estado }}
                            </span>
                        </div>
                        <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-gray-500">
                            <span>Edificio <strong class="text-gray-700">{{ s.edificio }}</strong></span>
                            <span>Tamaño <strong class="text-gray-700">{{ s.tamano }}</strong></span>
                            <span>Solicitado el <strong class="text-gray-700">{{ s.fecha }}</strong></span>
                        </div>
                        <!-- Motivo de rechazo -->
                        <p v-if="s.estado === 'Rechazada' && s.motivo"
                           class="text-xs text-[#DC2626] font-semibold mt-1 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            </svg>
                            {{ s.motivo }}
                        </p>
                    </div>

                    <!-- Indicador visual derecho -->
                    <div class="hidden sm:flex items-center">
                        <!-- Pendiente: spinner -->
                        <template v-if="s.estado === 'Pendiente'">
                            <div class="w-10 h-10 rounded-full border-4 border-[#213779] border-t-transparent animate-spin"></div>
                        </template>
                        <!-- Aprobada: check -->
                        <template v-else-if="s.estado === 'Aprobada'">
                            <div class="w-10 h-10 rounded-full bg-[#D1FAE5] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#0D7A5F" class="size-6">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </template>
                        <!-- Rechazada: X -->
                        <template v-else>
                            <div class="w-10 h-10 rounded-full bg-[#FEE2E2] flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#DC2626" class="size-6">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </template>
                    </div>

                </div>

            </div>

            <!-- Sin solicitudes -->
            <div v-else class="flex flex-col items-center justify-center py-20 gap-4 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-16">
                    <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Z" clip-rule="evenodd" />
                </svg>
                <p class="font-semibold text-lg">No tienes solicitudes aún</p>
                <p class="text-sm text-center">Solicita un locker desde la lista de casilleros disponibles.</p>
            </div>

        </section>
    </div>
</template>