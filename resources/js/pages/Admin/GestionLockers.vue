<script setup lang="ts">
    import { ref, computed } from 'vue';
    import LayoutAdmin from '../Layouts/LayoutAdmin.vue';
    import ModalComponent from '../Components/ModalComponent.vue';

    defineOptions({ layout: LayoutAdmin });

    // ── Tipos ──────────────────────────────────────────────────────────────
    interface Locker {
        id: number;
        codigo: string;
        edificio: string;
        piso: number;
        tamano: 'Pequeño' | 'Mediano' | 'Grande';
        estado: 'Disponible' | 'Ocupado' | 'Mantenimiento';
        usuario?: string;
    }

    // ── Datos mockeados ────────────────────────────────────────────────────
    const lockers = ref<Locker[]>([
        { id: 1,  codigo: 'A-101', edificio: 'A', piso: 1, tamano: 'Pequeño',  estado: 'Disponible'   },
        { id: 2,  codigo: 'A-102', edificio: 'A', piso: 1, tamano: 'Mediano',  estado: 'Ocupado',       usuario: 'Juan Pérez'   },
        { id: 3,  codigo: 'A-103', edificio: 'A', piso: 1, tamano: 'Grande',   estado: 'Disponible'    },
        { id: 4,  codigo: 'A-201', edificio: 'A', piso: 2, tamano: 'Pequeño',  estado: 'Mantenimiento' },
        { id: 5,  codigo: 'A-202', edificio: 'A', piso: 2, tamano: 'Mediano',  estado: 'Disponible'    },
        { id: 6,  codigo: 'B-101', edificio: 'B', piso: 1, tamano: 'Grande',   estado: 'Disponible'    },
        { id: 7,  codigo: 'B-102', edificio: 'B', piso: 1, tamano: 'Pequeño',  estado: 'Ocupado',       usuario: 'María González'},
        { id: 8,  codigo: 'B-103', edificio: 'B', piso: 1, tamano: 'Mediano',  estado: 'Disponible'    },
        { id: 9,  codigo: 'B-201', edificio: 'B', piso: 2, tamano: 'Grande',   estado: 'Ocupado',       usuario: 'Carlos Ruiz'  },
        { id: 10, codigo: 'B-202', edificio: 'B', piso: 2, tamano: 'Pequeño',  estado: 'Disponible'    },
        { id: 11, codigo: 'C-101', edificio: 'C', piso: 1, tamano: 'Mediano',  estado: 'Disponible'    },
        { id: 12, codigo: 'C-102', edificio: 'C', piso: 1, tamano: 'Grande',   estado: 'Mantenimiento' },
    ]);

    // ── Filtros ─────────────────────────────────────────────────────────────
    const filtroEdificio = ref('Todos');
    const filtroEstado   = ref('Todos');
    const busqueda       = ref('');

    const edificios = ['Todos', 'A', 'B', 'C'];
    const estados   = ['Todos', 'Disponible', 'Ocupado', 'Mantenimiento'];

    const lockersFiltrados = computed(() =>
        lockers.value.filter(l => {
            const porEdificio = filtroEdificio.value === 'Todos' || l.edificio === filtroEdificio.value;
            const porEstado   = filtroEstado.value   === 'Todos' || l.estado   === filtroEstado.value;
            const porBusqueda = l.codigo.toLowerCase().includes(busqueda.value.toLowerCase());
            return porEdificio && porEstado && porBusqueda;
        })
    );

    // ── Modal Agregar Locker ────────────────────────────────────────────────
    const modalAgregar = ref(false);
    const exitoAgregar = ref(false);
    const nuevoLocker = ref({
        codigo: '',
        edificio: 'A',
        piso: 1,
        tamano: 'Mediano' as Locker['tamano'],
        estado: 'Disponible' as Locker['estado'],
    });

    const guardarLocker = () => {
        if (!nuevoLocker.value.codigo) return;
        lockers.value.push({
            id: lockers.value.length + 1,
            ...nuevoLocker.value,
        });
        modalAgregar.value = false;
        exitoAgregar.value = true;
        nuevoLocker.value = { codigo: '', edificio: 'A', piso: 1, tamano: 'Mediano', estado: 'Disponible' };
    };

    // ── Helpers de estilo ───────────────────────────────────────────────────
    const estadoClases = (estado: string) => {
        if (estado === 'Disponible')    return 'bg-[#D1FAE5] text-[#0D7A5F]';
        if (estado === 'Ocupado')       return 'bg-[#FEE2E2] text-[#DC2626]';
        if (estado === 'Mantenimiento') return 'bg-[#FEF9C3] text-[#92400E]';
        return '';
    };

    // Estadísticas
    const totalLockers       = computed(() => lockers.value.length);
    const disponibles        = computed(() => lockers.value.filter(l => l.estado === 'Disponible').length);
    const ocupados           = computed(() => lockers.value.filter(l => l.estado === 'Ocupado').length);
    const enMantenimiento    = computed(() => lockers.value.filter(l => l.estado === 'Mantenimiento').length);
</script>

<template>
    <div class="flex flex-col items-center min-h-screen py-8 px-4">

        <section class="w-full max-w-6xl flex flex-col gap-6">

            <!-- Título y botón -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h1 class="text-2xl font-bold lg:text-3xl">Gestión de Casilleros</h1>
                <button
                    @click="modalAgregar = true"
                    class="flex items-center gap-2 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold
                           px-5 py-2 rounded-xl transition duration-300 active:scale-95 self-start sm:self-auto"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                    </svg>
                    Agregar Locker
                </button>
            </div>

            <!-- Tarjetas de estadísticas -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-[#213779] rounded-xl p-4 flex flex-col gap-1">
                    <p class="text-white text-xs font-semibold opacity-80">Total</p>
                    <p class="text-white text-3xl font-black">{{ totalLockers }}</p>
                </div>
                <div class="bg-[#0D7A5F] rounded-xl p-4 flex flex-col gap-1">
                    <p class="text-white text-xs font-semibold opacity-80">Disponibles</p>
                    <p class="text-white text-3xl font-black">{{ disponibles }}</p>
                </div>
                <div class="bg-[#1768B4] rounded-xl p-4 flex flex-col gap-1">
                    <p class="text-white text-xs font-semibold opacity-80">Ocupados</p>
                    <p class="text-white text-3xl font-black">{{ ocupados }}</p>
                </div>
                <div class="bg-[#F97316] rounded-xl p-4 flex flex-col gap-1">
                    <p class="text-white text-xs font-semibold opacity-80">Mantenimiento</p>
                    <p class="text-white text-3xl font-black">{{ enMantenimiento }}</p>
                </div>
            </div>

            <!-- Filtros -->
            <div class="flex flex-col sm:flex-row gap-3">
                <input
                    v-model="busqueda"
                    type="text"
                    placeholder="Buscar por código..."
                    class="flex-1 h-10 px-5 rounded-full bg-white border-2 border-[#A3A3A3]
                           focus:border-[#22397A] focus:outline-none text-[#404040] transition duration-200
                           placeholder:text-[#A3A3A3] placeholder:text-sm shadow-sm"
                >
                <select v-model="filtroEdificio"
                    class="h-10 px-4 rounded-full bg-white border-2 border-[#A3A3A3] focus:border-[#22397A]
                           focus:outline-none text-[#404040] transition duration-200 shadow-sm">
                    <option v-for="e in edificios" :key="e" :value="e">Edificio: {{ e }}</option>
                </select>
                <select v-model="filtroEstado"
                    class="h-10 px-4 rounded-full bg-white border-2 border-[#A3A3A3] focus:border-[#22397A]
                           focus:outline-none text-[#404040] transition duration-200 shadow-sm">
                    <option v-for="e in estados" :key="e" :value="e">{{ e }}</option>
                </select>
            </div>

            <!-- Tabla (desktop) / Cards (mobile) -->
            <!-- TABLA DESKTOP -->
            <div class="hidden md:block bg-white rounded-2xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.08)] overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-[#1C2F5E] text-white">
                        <tr>
                            <th class="text-left px-5 py-3 font-semibold">Código</th>
                            <th class="text-left px-5 py-3 font-semibold">Edificio</th>
                            <th class="text-left px-5 py-3 font-semibold">Piso</th>
                            <th class="text-left px-5 py-3 font-semibold">Tamaño</th>
                            <th class="text-left px-5 py-3 font-semibold">Estado</th>
                            <th class="text-left px-5 py-3 font-semibold">Usuario</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr v-for="l in lockersFiltrados" :key="l.id" class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-black text-[#213779]">{{ l.codigo }}</td>
                            <td class="px-5 py-3 text-gray-700">{{ l.edificio }}</td>
                            <td class="px-5 py-3 text-gray-700">{{ l.piso }}</td>
                            <td class="px-5 py-3 text-gray-700">{{ l.tamano }}</td>
                            <td class="px-5 py-3">
                                <span :class="['text-xs font-bold px-2 py-1 rounded-full', estadoClases(l.estado)]">
                                    {{ l.estado }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-500 text-sm">{{ l.usuario ?? '—' }}</td>
                        </tr>
                        <tr v-if="lockersFiltrados.length === 0">
                            <td colspan="6" class="text-center py-10 text-gray-400 font-semibold">
                                No se encontraron casilleros
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- CARDS MOBILE -->
            <div class="flex flex-col gap-4 md:hidden">
                <div v-if="lockersFiltrados.length === 0" class="text-center py-10 text-gray-400 font-semibold">
                    No se encontraron casilleros
                </div>
                <div
                    v-for="l in lockersFiltrados"
                    :key="l.id"
                    class="bg-white rounded-xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.08)] p-4"
                >
                    <div class="flex items-center justify-between mb-2">
                        <p class="font-black text-[#213779] text-lg">{{ l.codigo }}</p>
                        <span :class="['text-xs font-bold px-2 py-1 rounded-full', estadoClases(l.estado)]">
                            {{ l.estado }}
                        </span>
                    </div>
                    <div class="grid grid-cols-2 gap-1 text-sm text-gray-600">
                        <span>Edificio: <strong>{{ l.edificio }}</strong></span>
                        <span>Piso: <strong>{{ l.piso }}</strong></span>
                        <span>Tamaño: <strong>{{ l.tamano }}</strong></span>
                        <span>Usuario: <strong>{{ l.usuario ?? '—' }}</strong></span>
                    </div>
                </div>
            </div>

        </section>

        <!-- ─── Modal Agregar Locker ─── -->
        <dialog
            :open="modalAgregar"
            class="fixed inset-0 m-auto w-[90%] max-w-md rounded-2xl shadow-2xl border-none p-0 z-50
                   backdrop:bg-gray-900/60 backdrop:backdrop-blur-sm"
        >
            <div v-if="modalAgregar" class="bg-white rounded-2xl overflow-hidden">

                <!-- Header modal -->
                <div class="bg-[#213779] px-6 py-4 flex items-center justify-between">
                    <p class="text-white font-bold text-lg">Agregar Locker</p>
                    <button @click="modalAgregar = false" class="text-white/70 hover:text-white text-2xl leading-none">&times;</button>
                </div>

                <div class="p-6 flex flex-col gap-4">

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-[#404040]">Código del Locker</label>
                        <input v-model="nuevoLocker.codigo" type="text" placeholder="Ej: D-101"
                            class="w-full h-10 px-5 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                   focus:border-[#22397A] focus:outline-none text-[#404040] transition"/>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-semibold text-[#404040]">Edificio</label>
                            <select v-model="nuevoLocker.edificio"
                                class="h-10 px-4 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                       focus:border-[#22397A] focus:outline-none text-[#404040] transition">
                                <option>A</option><option>B</option><option>C</option><option>D</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-semibold text-[#404040]">Piso</label>
                            <input v-model.number="nuevoLocker.piso" type="number" min="1" max="10"
                                class="h-10 px-5 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                       focus:border-[#22397A] focus:outline-none text-[#404040] transition"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-semibold text-[#404040]">Tamaño</label>
                            <select v-model="nuevoLocker.tamano"
                                class="h-10 px-4 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                       focus:border-[#22397A] focus:outline-none text-[#404040] transition">
                                <option>Pequeño</option><option>Mediano</option><option>Grande</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="text-sm font-semibold text-[#404040]">Estado</label>
                            <select v-model="nuevoLocker.estado"
                                class="h-10 px-4 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                       focus:border-[#22397A] focus:outline-none text-[#404040] transition">
                                <option>Disponible</option><option>Mantenimiento</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button @click="modalAgregar = false"
                            class="flex-1 py-2 border-2 border-gray-300 text-gray-600 font-bold rounded-xl
                                   hover:bg-gray-50 transition duration-200">
                            Cancelar
                        </button>
                        <button @click="guardarLocker"
                            class="flex-1 py-2 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold rounded-xl
                                   transition duration-300 active:scale-95">
                            Guardar
                        </button>
                    </div>

                </div>
            </div>
        </dialog>

        <!-- Modal éxito -->
        <ModalComponent
            :show="exitoAgregar"
            text="¡Locker agregado correctamente!"
            url="/gestion-lockers-admin"
            title-button="Continuar"
            @close="exitoAgregar = false"
        />

    </div>
</template>