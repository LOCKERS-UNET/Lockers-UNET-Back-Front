<script setup lang="ts">
    import { ref, computed } from 'vue';
    import Layout from '../Layouts/Layout.vue';
    import ModalComponent from '../Components/ModalComponent.vue';

    defineOptions({ layout: Layout });

    // ── Tipos ──────────────────────────────────────────────────────────────
    interface Locker {
        id: number;
        codigo: string;
        edificio: string;
        piso: number;
        tamano: 'Pequeño' | 'Mediano' | 'Grande';
        estado: 'Disponible' | 'Ocupado' | 'Mantenimiento';
    }

    // ── Datos mockeados ────────────────────────────────────────────────────
    const lockers: Locker[] = [
        { id: 1,  codigo: 'A-101', edificio: 'A', piso: 1, tamano: 'Pequeño',  estado: 'Disponible'   },
        { id: 2,  codigo: 'A-102', edificio: 'A', piso: 1, tamano: 'Mediano',  estado: 'Ocupado'       },
        { id: 3,  codigo: 'A-103', edificio: 'A', piso: 1, tamano: 'Grande',   estado: 'Disponible'    },
        { id: 4,  codigo: 'A-201', edificio: 'A', piso: 2, tamano: 'Pequeño',  estado: 'Mantenimiento' },
        { id: 5,  codigo: 'A-202', edificio: 'A', piso: 2, tamano: 'Mediano',  estado: 'Disponible'    },
        { id: 6,  codigo: 'B-101', edificio: 'B', piso: 1, tamano: 'Grande',   estado: 'Disponible'    },
        { id: 7,  codigo: 'B-102', edificio: 'B', piso: 1, tamano: 'Pequeño',  estado: 'Ocupado'       },
        { id: 8,  codigo: 'B-103', edificio: 'B', piso: 1, tamano: 'Mediano',  estado: 'Disponible'    },
        { id: 9,  codigo: 'B-201', edificio: 'B', piso: 2, tamano: 'Grande',   estado: 'Ocupado'       },
        { id: 10, codigo: 'B-202', edificio: 'B', piso: 2, tamano: 'Pequeño',  estado: 'Disponible'    },
        { id: 11, codigo: 'C-101', edificio: 'C', piso: 1, tamano: 'Mediano',  estado: 'Disponible'    },
        { id: 12, codigo: 'C-102', edificio: 'C', piso: 1, tamano: 'Grande',   estado: 'Mantenimiento' },
    ];

    // ── Filtros ─────────────────────────────────────────────────────────────
    const filtroEdificio = ref<string>('Todos');
    const filtroEstado   = ref<string>('Todos');

    const edificios = ['Todos', 'A', 'B', 'C'];
    const estados   = ['Todos', 'Disponible', 'Ocupado', 'Mantenimiento'];

    const lockersFiltrados = computed(() =>
        lockers.filter(l => {
            const porEdificio = filtroEdificio.value === 'Todos' || l.edificio === filtroEdificio.value;
            const porEstado   = filtroEstado.value   === 'Todos' || l.estado   === filtroEstado.value;
            return porEdificio && porEstado;
        })
    );

    // ── Modal de solicitud ──────────────────────────────────────────────────
    const modalAbierto   = ref(false);
    const exitoModal     = ref(false);
    const lockerSelected = ref<Locker | null>(null);

    const abrirModal = (locker: Locker) => {
        lockerSelected.value = locker;
        modalAbierto.value   = true;
    };

    const confirmarSolicitud = () => {
        modalAbierto.value = false;
        exitoModal.value   = true;
    };

    // ── Helpers de estilo ───────────────────────────────────────────────────
    const estadoClases = (estado: string) => {
        if (estado === 'Disponible')    return 'bg-[#D1FAE5] text-[#0D7A5F]';
        if (estado === 'Ocupado')       return 'bg-[#FEE2E2] text-[#DC2626]';
        if (estado === 'Mantenimiento') return 'bg-[#FEF9C3] text-[#92400E]';
        return '';
    };
</script>

<template>
    <div class="flex flex-col items-center min-h-screen py-8 px-4">

        <section class="w-full max-w-5xl flex flex-col gap-6">

            <h1 class="text-2xl font-bold lg:text-3xl text-center">Lista de Casilleros</h1>

            <!-- Filtros -->
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-6">

                <div class="flex flex-col gap-1 flex-1">
                    <label class="text-sm font-semibold text-[#404040] ml-1">Edificio</label>
                    <select
                        v-model="filtroEdificio"
                        class="w-full h-10 px-4 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                               focus:border-[#22397A] focus:outline-none text-[#404040] transition duration-200"
                    >
                        <option v-for="e in edificios" :key="e" :value="e">{{ e }}</option>
                    </select>
                </div>

                <div class="flex flex-col gap-1 flex-1">
                    <label class="text-sm font-semibold text-[#404040] ml-1">Estado</label>
                    <select
                        v-model="filtroEstado"
                        class="w-full h-10 px-4 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                               focus:border-[#22397A] focus:outline-none text-[#404040] transition duration-200"
                    >
                        <option v-for="e in estados" :key="e" :value="e">{{ e }}</option>
                    </select>
                </div>

            </div>

            <!-- Leyenda de estados -->
            <div class="flex flex-wrap gap-3 text-sm">
                <span class="flex items-center gap-1">
                    <span class="w-3 h-3 rounded-full bg-[#0D7A5F] inline-block"></span> Disponible
                </span>
                <span class="flex items-center gap-1">
                    <span class="w-3 h-3 rounded-full bg-[#DC2626] inline-block"></span> Ocupado
                </span>
                <span class="flex items-center gap-1">
                    <span class="w-3 h-3 rounded-full bg-[#92400E] inline-block"></span> Mantenimiento
                </span>
            </div>

            <!-- Grid de casilleros -->
            <div v-if="lockersFiltrados.length > 0"
                 class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">

                <div
                    v-for="locker in lockersFiltrados"
                    :key="locker.id"
                    class="flex flex-col gap-3 bg-white rounded-xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.1)] p-4 transition hover:shadow-md"
                >
                    <!-- Ícono locker -->
                    <div class="flex justify-between items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#3A6BC8" class="size-8">
                            <path fill-rule="evenodd" d="M4.5 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5h-.75V3.75a.75.75 0 0 0 0-1.5h-15ZM9 6a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm-.75 3.75A.75.75 0 0 1 9 9h1.5a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM9 12a.75.75 0 0 0 0 1.5h1.5a.75.75 0 0 0 0-1.5H9Zm3.75-5.25A.75.75 0 0 1 13.5 6H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM13.5 9a.75.75 0 0 0 0 1.5H15A.75.75 0 0 0 15 9h-1.5Zm-.75 3.75a.75.75 0 0 1 .75-.75H15a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75ZM9 19.5v-2.25a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-4.5A.75.75 0 0 1 9 19.5Z" clip-rule="evenodd" />
                        </svg>
                        <span :class="['text-xs font-bold px-2 py-1 rounded-full', estadoClases(locker.estado)]">
                            {{ locker.estado }}
                        </span>
                    </div>

                    <div>
                        <p class="font-black text-[#213779] text-lg">{{ locker.codigo }}</p>
                        <p class="text-xs text-gray-500">Edificio {{ locker.edificio }} · Piso {{ locker.piso }}</p>
                        <p class="text-xs text-gray-500">Tamaño: {{ locker.tamano }}</p>
                    </div>

                    <button
                        v-if="locker.estado === 'Disponible'"
                        @click="abrirModal(locker)"
                        class="w-full py-2 bg-[#213779] hover:bg-[#1a2b5f] text-white text-sm font-bold
                               rounded-lg transition duration-300 active:scale-95"
                    >
                        Solicitar
                    </button>
                    <div v-else class="py-2 text-center text-xs text-gray-400 font-semibold">
                        No disponible
                    </div>

                </div>
            </div>

            <!-- Sin resultados -->
            <div v-else class="flex flex-col items-center justify-center py-16 gap-4 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-16">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                </svg>
                <p class="font-semibold text-lg">No se encontraron casilleros</p>
            </div>

        </section>

        <!-- ─── Modal de confirmación de solicitud ─── -->
        <dialog
            :open="modalAbierto"
            class="fixed inset-0 m-auto w-[90%] max-w-md rounded-xl shadow-2xl border-none p-0 backdrop:bg-gray-900/60"
        >
            <div v-if="modalAbierto && lockerSelected" class="bg-white p-6 rounded-xl">

                <h3 class="text-xl font-black text-center mb-4">Solicitud de Locker</h3>

                <div class="bg-gray-50 rounded-xl p-4 flex flex-col gap-2 mb-6">
                    <div class="flex justify-between">
                        <span class="text-sm font-semibold text-gray-600">Código</span>
                        <span class="text-sm font-black text-[#213779]">{{ lockerSelected.codigo }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-semibold text-gray-600">Edificio</span>
                        <span class="text-sm font-bold">{{ lockerSelected.edificio }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-semibold text-gray-600">Piso</span>
                        <span class="text-sm font-bold">{{ lockerSelected.piso }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-semibold text-gray-600">Tamaño</span>
                        <span class="text-sm font-bold">{{ lockerSelected.tamano }}</span>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button
                        @click="modalAbierto = false"
                        class="flex-1 py-2 border-2 border-gray-300 text-gray-600 font-bold rounded-xl
                               hover:bg-gray-50 transition duration-200"
                    >
                        Cancelar
                    </button>
                    <button
                        @click="confirmarSolicitud"
                        class="flex-1 py-2 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold rounded-xl
                               transition duration-300 active:scale-95"
                    >
                        Confirmar
                    </button>
                </div>
            </div>
        </dialog>

        <!-- ─── Modal de éxito ─── -->
        <ModalComponent
            :show="exitoModal"
            text="¡Solicitud enviada correctamente!"
            url="/"
            title-button="Volver al inicio"
            @close="exitoModal = false"
        />

    </div>
</template>