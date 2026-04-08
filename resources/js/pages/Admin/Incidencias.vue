<script setup lang="ts">
    import { ref, computed } from 'vue';
    import LayoutAdmin from '../Layouts/LayoutAdmin.vue';

    defineOptions({ layout: LayoutAdmin });

    // ── Tipos ──────────────────────────────────────────────────────────────
    interface Incidencia {
        id: number;
        usuario: string;
        carnet: string;
        locker: string;
        tipo: string;
        descripcion: string;
        fecha: string;
        estado: 'Pendiente' | 'En proceso' | 'Resuelta';
    }

    // ── Datos mockeados ────────────────────────────────────────────────────
    const incidencias = ref<Incidencia[]>([
        { id: 1, usuario: 'Juan Pérez',      carnet: '12345', locker: 'B-142', tipo: 'Daño físico',   descripcion: 'La puerta del casillero no cierra correctamente.',     fecha: '07/04/2026', estado: 'Pendiente'  },
        { id: 2, usuario: 'María González',  carnet: '23456', locker: 'A-103', tipo: 'Pérdida clave', descripcion: 'Se perdió la llave del casillero asignado.',            fecha: '05/04/2026', estado: 'En proceso' },
        { id: 3, usuario: 'Carlos Ruiz',     carnet: '34567', locker: 'B-201', tipo: 'Robo',          descripcion: 'Reporta posible robo de pertenencias del casillero.',  fecha: '03/04/2026', estado: 'Resuelta'   },
        { id: 4, usuario: 'Ana Martínez',    carnet: '45678', locker: 'C-101', tipo: 'Daño físico',   descripcion: 'Casillero presenta golpes y el seguro está dañado.',  fecha: '01/04/2026', estado: 'Pendiente'  },
        { id: 5, usuario: 'Pedro Sánchez',   carnet: '56789', locker: 'A-202', tipo: 'Otro',          descripcion: 'El número del casillero no corresponde al asignado.', fecha: '28/03/2026', estado: 'Resuelta'   },
    ]);

    // ── Filtro ───────────────────────────────────────────────────────────────
    const filtroEstado = ref('Todos');
    const estados = ['Todos', 'Pendiente', 'En proceso', 'Resuelta'];

    const incidenciasFiltradas = computed(() =>
        incidencias.value.filter(i =>
            filtroEstado.value === 'Todos' || i.estado === filtroEstado.value
        )
    );

    // ── Cambiar estado ───────────────────────────────────────────────────────
    const cambiarEstado = (incidencia: Incidencia, nuevoEstado: Incidencia['estado']) => {
        incidencia.estado = nuevoEstado;
    };

    // ── Helpers ─────────────────────────────────────────────────────────────
    const estadoClases = (estado: string) => {
        if (estado === 'Resuelta')   return 'bg-[#D1FAE5] text-[#0D7A5F]';
        if (estado === 'En proceso') return 'bg-[#FEF9C3] text-[#92400E]';
        return 'bg-[#FEE2E2] text-[#DC2626]';
    };

    // Detalle modal
    const incidenciaDetalle = ref<Incidencia | null>(null);
    const verDetalle = (i: Incidencia) => { incidenciaDetalle.value = i; };
    const cerrarDetalle = () => { incidenciaDetalle.value = null; };
</script>

<template>
    <div class="flex flex-col items-center min-h-screen py-8 px-4">

        <section class="w-full max-w-6xl flex flex-col gap-6">

            <!-- Título y filtro -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h1 class="text-2xl font-bold lg:text-3xl">Incidencias</h1>
                <select v-model="filtroEstado"
                    class="h-10 px-4 rounded-full bg-white border-2 border-[#A3A3A3] focus:border-[#22397A]
                           focus:outline-none text-[#404040] transition shadow-sm self-start sm:self-auto">
                    <option v-for="e in estados" :key="e" :value="e">{{ e }}</option>
                </select>
            </div>

            <!-- Contadores -->
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-[#FEE2E2] rounded-xl p-4 text-center">
                    <p class="text-[#DC2626] text-2xl font-black">{{ incidencias.filter(i => i.estado === 'Pendiente').length }}</p>
                    <p class="text-[#DC2626] text-xs font-bold mt-1">Pendientes</p>
                </div>
                <div class="bg-[#FEF9C3] rounded-xl p-4 text-center">
                    <p class="text-[#92400E] text-2xl font-black">{{ incidencias.filter(i => i.estado === 'En proceso').length }}</p>
                    <p class="text-[#92400E] text-xs font-bold mt-1">En Proceso</p>
                </div>
                <div class="bg-[#D1FAE5] rounded-xl p-4 text-center">
                    <p class="text-[#0D7A5F] text-2xl font-black">{{ incidencias.filter(i => i.estado === 'Resuelta').length }}</p>
                    <p class="text-[#0D7A5F] text-xs font-bold mt-1">Resueltas</p>
                </div>
            </div>

            <!-- TABLA DESKTOP -->
            <div class="hidden md:block bg-white rounded-2xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.08)] overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-[#1C2F5E] text-white">
                        <tr>
                            <th class="text-left px-5 py-3 font-semibold">Usuario</th>
                            <th class="text-left px-5 py-3 font-semibold">Carnet</th>
                            <th class="text-left px-5 py-3 font-semibold">Locker</th>
                            <th class="text-left px-5 py-3 font-semibold">Tipo</th>
                            <th class="text-left px-5 py-3 font-semibold">Fecha</th>
                            <th class="text-left px-5 py-3 font-semibold">Estado</th>
                            <th class="text-left px-5 py-3 font-semibold">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr v-for="i in incidenciasFiltradas" :key="i.id" class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-semibold text-gray-800">{{ i.usuario }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ i.carnet }}</td>
                            <td class="px-5 py-3 font-bold text-[#213779]">{{ i.locker }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ i.tipo }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ i.fecha }}</td>
                            <td class="px-5 py-3">
                                <span :class="['text-xs font-bold px-2 py-1 rounded-full', estadoClases(i.estado)]">
                                    {{ i.estado }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2">
                                    <button @click="verDetalle(i)"
                                        class="text-[#213779] hover:underline text-xs font-bold">
                                        Ver
                                    </button>
                                    <button v-if="i.estado !== 'Resuelta'"
                                        @click="cambiarEstado(i, i.estado === 'Pendiente' ? 'En proceso' : 'Resuelta')"
                                        class="text-[#0D7A5F] hover:underline text-xs font-bold">
                                        {{ i.estado === 'Pendiente' ? 'Procesar' : 'Resolver' }}
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="incidenciasFiltradas.length === 0">
                            <td colspan="7" class="text-center py-10 text-gray-400 font-semibold">
                                No se encontraron incidencias
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- CARDS MOBILE -->
            <div class="flex flex-col gap-4 md:hidden">
                <div v-if="incidenciasFiltradas.length === 0" class="text-center py-10 text-gray-400 font-semibold">
                    No hay incidencias
                </div>
                <div v-for="i in incidenciasFiltradas" :key="i.id"
                     class="bg-white rounded-xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.08)] p-4 flex flex-col gap-3">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-bold text-gray-800">{{ i.usuario }}</p>
                            <p class="text-xs text-gray-500">{{ i.carnet }} · Locker <strong class="text-[#213779]">{{ i.locker }}</strong></p>
                        </div>
                        <span :class="['text-xs font-bold px-2 py-1 rounded-full', estadoClases(i.estado)]">
                            {{ i.estado }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600"><strong>Tipo:</strong> {{ i.tipo }}</p>
                    <p class="text-xs text-gray-500">{{ i.descripcion }}</p>
                    <div class="flex gap-2 pt-1">
                        <button @click="verDetalle(i)"
                            class="flex-1 py-1.5 border-2 border-[#213779] text-[#213779] text-sm font-bold
                                   rounded-xl hover:bg-[#EBF0FA] transition">
                            Ver detalle
                        </button>
                        <button v-if="i.estado !== 'Resuelta'"
                            @click="cambiarEstado(i, i.estado === 'Pendiente' ? 'En proceso' : 'Resuelta')"
                            class="flex-1 py-1.5 bg-[#0D7A5F] text-white text-sm font-bold rounded-xl hover:bg-[#0a6350] transition">
                            {{ i.estado === 'Pendiente' ? 'Procesar' : 'Resolver' }}
                        </button>
                    </div>
                </div>
            </div>

        </section>

        <!-- Modal detalle -->
        <dialog :open="!!incidenciaDetalle"
            class="fixed inset-0 m-auto w-[90%] max-w-md rounded-2xl shadow-2xl border-none p-0 z-50
                   backdrop:bg-gray-900/60 backdrop:backdrop-blur-sm">
            <div v-if="incidenciaDetalle" class="bg-white rounded-2xl overflow-hidden">
                <div class="bg-[#213779] px-6 py-4 flex items-center justify-between">
                    <p class="text-white font-bold">Detalle de Incidencia</p>
                    <button @click="cerrarDetalle" class="text-white/70 hover:text-white text-2xl leading-none">&times;</button>
                </div>
                <div class="p-6 flex flex-col gap-3 text-sm">
                    <div class="flex justify-between"><span class="text-gray-500 font-semibold">Usuario</span><span class="font-bold">{{ incidenciaDetalle.usuario }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-semibold">Carnet</span><span class="font-bold">{{ incidenciaDetalle.carnet }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-semibold">Locker</span><span class="font-black text-[#213779]">{{ incidenciaDetalle.locker }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-semibold">Tipo</span><span class="font-bold">{{ incidenciaDetalle.tipo }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-500 font-semibold">Fecha</span><span class="font-bold">{{ incidenciaDetalle.fecha }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-500 font-semibold">Estado</span>
                        <span :class="['text-xs font-bold px-2 py-1 rounded-full', estadoClases(incidenciaDetalle.estado)]">{{ incidenciaDetalle.estado }}</span>
                    </div>
                    <div class="border-t pt-3">
                        <p class="text-gray-500 font-semibold mb-1">Descripción</p>
                        <p class="text-gray-700 leading-relaxed">{{ incidenciaDetalle.descripcion }}</p>
                    </div>
                    <button @click="cerrarDetalle"
                        class="mt-2 w-full py-2 bg-[#213779] text-white font-bold rounded-xl hover:bg-[#1a2b5f] transition">
                        Cerrar
                    </button>
                </div>
            </div>
        </dialog>

    </div>
</template>