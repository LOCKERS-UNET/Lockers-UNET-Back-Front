<script setup lang="ts">
    import { ref, computed } from 'vue';
    import LayoutAdmin from '../Layouts/LayoutAdmin.vue';
    import ModalComponent from '../Components/ModalComponent.vue';

    defineOptions({ layout: LayoutAdmin });

    // ── Tipos ──────────────────────────────────────────────────────────────
    interface Asignacion {
        id: number;
        usuario: string;
        carnet: string;
        locker: string;
        edificio: string;
        tamano: string;
        fechaInicio: string;
        fechaFin: string;
        estado: 'Activa' | 'Liberada';
    }

    // ── Datos mockeados ────────────────────────────────────────────────────
    const asignaciones = ref<Asignacion[]>([
        { id: 1, usuario: 'Juan Pérez',     carnet: '12345', locker: 'B-142', edificio: 'B', tamano: 'Mediano',  fechaInicio: '10/01/2026', fechaFin: '30/06/2026', estado: 'Activa'   },
        { id: 2, usuario: 'María González', carnet: '23456', locker: 'A-103', edificio: 'A', tamano: 'Grande',   fechaInicio: '15/01/2026', fechaFin: '30/06/2026', estado: 'Activa'   },
        { id: 3, usuario: 'Carlos Ruiz',    carnet: '34567', locker: 'B-201', edificio: 'B', tamano: 'Grande',   fechaInicio: '20/01/2026', fechaFin: '30/06/2026', estado: 'Liberada' },
        { id: 4, usuario: 'Ana Martínez',   carnet: '45678', locker: 'C-101', edificio: 'C', tamano: 'Pequeño',  fechaInicio: '05/02/2026', fechaFin: '30/06/2026', estado: 'Activa'   },
    ]);

    // Lockers disponibles (para asignar nuevo)
    const lockersDisponibles = ['A-101', 'A-202', 'B-103', 'B-202', 'C-102'];

    const filtroEstado = ref('Todos');
    const estados      = ['Todos', 'Activa', 'Liberada'];

    const asignacionesFiltradas = computed(() =>
        asignaciones.value.filter(a =>
            filtroEstado.value === 'Todos' || a.estado === filtroEstado.value
        )
    );

    // ── Modal Liberar ───────────────────────────────────────────────────────
    const modalLiberar     = ref(false);
    const exitoLiberar     = ref(false);
    const asignacionLiberar = ref<Asignacion | null>(null);

    const abrirLiberar = (a: Asignacion) => {
        asignacionLiberar.value = a;
        modalLiberar.value = true;
    };

    const confirmarLiberar = () => {
        if (asignacionLiberar.value) {
            asignacionLiberar.value.estado = 'Liberada';
        }
        modalLiberar.value = false;
        exitoLiberar.value = true;
    };

    // ── Modal Asignar ────────────────────────────────────────────────────────
    const modalAsignar = ref(false);
    const exitoAsignar = ref(false);
    const nuevaAsignacion = ref({
        carnet: '',
        usuario: '',
        locker: lockersDisponibles[0],
        fechaInicio: '',
        fechaFin: '',
    });

    const crearAsignacion = () => {
        asignaciones.value.push({
            id: asignaciones.value.length + 1,
            usuario: nuevaAsignacion.value.usuario || 'Usuario nuevo',
            carnet: nuevaAsignacion.value.carnet,
            locker: nuevaAsignacion.value.locker,
            edificio: nuevaAsignacion.value.locker.charAt(0),
            tamano: 'Mediano',
            fechaInicio: nuevaAsignacion.value.fechaInicio,
            fechaFin: nuevaAsignacion.value.fechaFin,
            estado: 'Activa',
        });
        modalAsignar.value = false;
        exitoAsignar.value = true;
        nuevaAsignacion.value = { carnet: '', usuario: '', locker: lockersDisponibles[0], fechaInicio: '', fechaFin: '' };
    };

    // ── Helpers ─────────────────────────────────────────────────────────────
    const estadoClases = (estado: string) =>
        estado === 'Activa' ? 'bg-[#D1FAE5] text-[#0D7A5F]' : 'bg-gray-100 text-gray-500';
</script>

<template>
    <div class="flex flex-col items-center min-h-screen py-8 px-4">

        <section class="w-full max-w-6xl flex flex-col gap-6">

            <!-- Título y botón -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h1 class="text-2xl font-bold lg:text-3xl">Asignaciones</h1>
                <div class="flex gap-3">
                    <select v-model="filtroEstado"
                        class="h-10 px-4 rounded-full bg-white border-2 border-[#A3A3A3] focus:border-[#22397A]
                               focus:outline-none text-[#404040] transition shadow-sm">
                        <option v-for="e in estados" :key="e" :value="e">{{ e }}</option>
                    </select>
                    <button @click="modalAsignar = true"
                        class="flex items-center gap-2 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold
                               px-5 py-2 rounded-xl transition duration-300 active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                        Asignar
                    </button>
                </div>
            </div>

            <!-- Estadísticas rápidas -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-[#D1FAE5] rounded-xl p-4 text-center">
                    <p class="text-[#0D7A5F] text-2xl font-black">{{ asignaciones.filter(a => a.estado === 'Activa').length }}</p>
                    <p class="text-[#0D7A5F] text-xs font-bold mt-1">Activas</p>
                </div>
                <div class="bg-gray-100 rounded-xl p-4 text-center">
                    <p class="text-gray-600 text-2xl font-black">{{ asignaciones.filter(a => a.estado === 'Liberada').length }}</p>
                    <p class="text-gray-500 text-xs font-bold mt-1">Liberadas</p>
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
                            <th class="text-left px-5 py-3 font-semibold">Edificio</th>
                            <th class="text-left px-5 py-3 font-semibold">Inicio</th>
                            <th class="text-left px-5 py-3 font-semibold">Fin</th>
                            <th class="text-left px-5 py-3 font-semibold">Estado</th>
                            <th class="text-left px-5 py-3 font-semibold">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr v-for="a in asignacionesFiltradas" :key="a.id" class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-semibold text-gray-800">{{ a.usuario }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ a.carnet }}</td>
                            <td class="px-5 py-3 font-black text-[#213779]">{{ a.locker }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ a.edificio }}</td>
                            <td class="px-5 py-3 text-gray-500 text-xs">{{ a.fechaInicio }}</td>
                            <td class="px-5 py-3 text-gray-500 text-xs">{{ a.fechaFin }}</td>
                            <td class="px-5 py-3">
                                <span :class="['text-xs font-bold px-2 py-1 rounded-full', estadoClases(a.estado)]">
                                    {{ a.estado }}
                                </span>
                            </td>
                            <td class="px-5 py-3">
                                <button v-if="a.estado === 'Activa'"
                                    @click="abrirLiberar(a)"
                                    class="text-[#DC2626] hover:text-red-800 font-bold text-xs border border-[#DC2626]
                                           px-3 py-1 rounded-full hover:bg-red-50 transition">
                                    Liberar
                                </button>
                                <span v-else class="text-xs text-gray-400">—</span>
                            </td>
                        </tr>
                        <tr v-if="asignacionesFiltradas.length === 0">
                            <td colspan="8" class="text-center py-10 text-gray-400 font-semibold">
                                No se encontraron asignaciones
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- CARDS MOBILE -->
            <div class="flex flex-col gap-4 md:hidden">
                <div v-if="asignacionesFiltradas.length === 0" class="text-center py-10 text-gray-400 font-semibold">
                    No hay asignaciones
                </div>
                <div v-for="a in asignacionesFiltradas" :key="a.id"
                     class="bg-white rounded-xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.08)] p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <p class="font-bold text-gray-800">{{ a.usuario }}</p>
                            <p class="text-xs text-gray-500">{{ a.carnet }}</p>
                        </div>
                        <span :class="['text-xs font-bold px-2 py-1 rounded-full', estadoClases(a.estado)]">
                            {{ a.estado }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-600 flex flex-col gap-1">
                        <p>Locker: <strong class="text-[#213779]">{{ a.locker }}</strong> · Edificio {{ a.edificio }}</p>
                        <p>{{ a.fechaInicio }} → {{ a.fechaFin }}</p>
                    </div>
                    <button v-if="a.estado === 'Activa'"
                        @click="abrirLiberar(a)"
                        class="mt-3 w-full py-2 border-2 border-[#DC2626] text-[#DC2626] font-bold rounded-xl
                               hover:bg-red-50 transition text-sm">
                        Liberar Locker
                    </button>
                </div>
            </div>

        </section>

        <!-- ─── Modal Liberar ─── -->
        <dialog :open="modalLiberar"
            class="fixed inset-0 m-auto w-[90%] max-w-sm rounded-2xl shadow-2xl border-none p-0 z-50
                   backdrop:bg-gray-900/60 backdrop:backdrop-blur-sm">
            <div v-if="modalLiberar && asignacionLiberar" class="bg-white rounded-2xl overflow-hidden">
                <div class="bg-[#DC2626] px-6 py-4 flex items-center justify-between">
                    <p class="text-white font-bold">Liberar Locker</p>
                    <button @click="modalLiberar = false" class="text-white/70 hover:text-white text-2xl leading-none">&times;</button>
                </div>
                <div class="p-6 flex flex-col gap-4">
                    <p class="text-gray-700 text-sm text-center">
                        ¿Estás seguro que deseas liberar el locker
                        <strong class="text-[#213779]">{{ asignacionLiberar.locker }}</strong>
                        asignado a <strong>{{ asignacionLiberar.usuario }}</strong>?
                    </p>
                    <div class="bg-[#FEF9C3] rounded-xl p-3 text-xs text-[#92400E] font-semibold text-center">
                        Esta acción no se puede deshacer.
                    </div>
                    <div class="flex gap-3">
                        <button @click="modalLiberar = false"
                            class="flex-1 py-2 border-2 border-gray-300 text-gray-600 font-bold rounded-xl
                                   hover:bg-gray-50 transition">
                            Cancelar
                        </button>
                        <button @click="confirmarLiberar"
                            class="flex-1 py-2 bg-[#DC2626] hover:bg-red-800 text-white font-bold rounded-xl
                                   transition duration-300 active:scale-95">
                            Liberar
                        </button>
                    </div>
                </div>
            </div>
        </dialog>

        <!-- ─── Modal Asignar ─── -->
        <dialog :open="modalAsignar"
            class="fixed inset-0 m-auto w-[90%] max-w-md rounded-2xl shadow-2xl border-none p-0 z-50
                   backdrop:bg-gray-900/60 backdrop:backdrop-blur-sm">
            <div v-if="modalAsignar" class="bg-white rounded-2xl overflow-hidden">
                <div class="bg-[#213779] px-6 py-4 flex items-center justify-between">
                    <p class="text-white font-bold text-lg">Asignar Locker</p>
                    <button @click="modalAsignar = false" class="text-white/70 hover:text-white text-2xl leading-none">&times;</button>
                </div>
                <div class="p-6 flex flex-col gap-4">

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-[#404040]">Carnet del Estudiante</label>
                        <input v-model="nuevaAsignacion.carnet" type="text" placeholder="Ej: 12345"
                            class="w-full h-10 px-5 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                   focus:border-[#22397A] focus:outline-none text-[#404040] transition"/>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-[#404040]">Nombre del Estudiante</label>
                        <input v-model="nuevaAsignacion.usuario" type="text" placeholder="Nombre completo"
                            class="w-full h-10 px-5 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                   focus:border-[#22397A] focus:outline-none text-[#404040] transition"/>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-[#404040]">Locker Disponible</label>
                        <select v-model="nuevaAsignacion.locker"
                            class="h-10 px-4 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                   focus:border-[#22397A] focus:outline-none text-[#404040] transition">
                            <option v-for="l in lockersDisponibles" :key="l" :value="l">{{ l }}</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-semibold text-[#404040]">Fecha Inicio</label>
                            <input v-model="nuevaAsignacion.fechaInicio" type="text" placeholder="DD/MM/AAAA"
                                class="h-10 px-4 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                       focus:border-[#22397A] focus:outline-none text-[#404040] transition text-sm"/>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-semibold text-[#404040]">Fecha Fin</label>
                            <input v-model="nuevaAsignacion.fechaFin" type="text" placeholder="DD/MM/AAAA"
                                class="h-10 px-4 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                       focus:border-[#22397A] focus:outline-none text-[#404040] transition text-sm"/>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button @click="modalAsignar = false"
                            class="flex-1 py-2 border-2 border-gray-300 text-gray-600 font-bold rounded-xl
                                   hover:bg-gray-50 transition duration-200">
                            Cancelar
                        </button>
                        <button @click="crearAsignacion"
                            class="flex-1 py-2 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold rounded-xl
                                   transition duration-300 active:scale-95">
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </dialog>

        <!-- Modales de éxito -->
        <ModalComponent
            :show="exitoLiberar"
            text="¡Locker liberado correctamente!"
            url="/asignaciones-admin"
            title-button="Continuar"
            @close="exitoLiberar = false"
        />
        <ModalComponent
            :show="exitoAsignar"
            text="¡Locker asignado correctamente!"
            url="/asignaciones-admin"
            title-button="Continuar"
            @close="exitoAsignar = false"
        />

    </div>
</template>