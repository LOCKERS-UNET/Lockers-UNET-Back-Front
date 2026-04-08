<script setup lang="ts">
    import { ref } from 'vue';
    import LayoutAdmin from '../Layouts/LayoutAdmin.vue';
    import ModalComponent from '../Components/ModalComponent.vue';

    defineOptions({ layout: LayoutAdmin });

    // ── Tipos ──────────────────────────────────────────────────────────────
    interface Arancel {
        id: number;
        tipo: string;
        tamano: string;
        monto: number;
        periodo: string;
        vigencia: string;
    }

    // ── Datos mockeados ────────────────────────────────────────────────────
    const aranceles = ref<Arancel[]>([
        { id: 1, tipo: 'Semestral', tamano: 'Pequeño', monto: 30.00, periodo: 'Ene – Jun 2026', vigencia: '15/06/2026' },
        { id: 2, tipo: 'Semestral', tamano: 'Mediano',  monto: 50.00, periodo: 'Ene – Jun 2026', vigencia: '15/06/2026' },
        { id: 3, tipo: 'Semestral', tamano: 'Grande',   monto: 70.00, periodo: 'Ene – Jun 2026', vigencia: '15/06/2026' },
        { id: 4, tipo: 'Anual',     tamano: 'Pequeño',  monto: 55.00, periodo: '2026',            vigencia: '31/12/2026' },
        { id: 5, tipo: 'Anual',     tamano: 'Mediano',  monto: 90.00, periodo: '2026',            vigencia: '31/12/2026' },
        { id: 6, tipo: 'Anual',     tamano: 'Grande',   monto: 130.00, periodo: '2026',           vigencia: '31/12/2026' },
    ]);

    // ── Modal Editar ────────────────────────────────────────────────────────
    const modalEditar  = ref(false);
    const exitoEditar  = ref(false);
    const arancelEdit  = ref<Arancel | null>(null);

    const abrirEditar = (a: Arancel) => {
        arancelEdit.value = { ...a };
        modalEditar.value = true;
    };

    const guardarEdicion = () => {
        if (!arancelEdit.value) return;
        const idx = aranceles.value.findIndex((a: Arancel) => a.id === arancelEdit.value!.id);
        if (idx !== -1) aranceles.value[idx] = { ...arancelEdit.value };
        modalEditar.value = false;
        exitoEditar.value = true;
    };

    const tamanoClases = (tamano: string) => {
        if (tamano === 'Grande')  return 'bg-[#EBF0FA] text-[#213779]';
        if (tamano === 'Mediano') return 'bg-[#E0F2FE] text-[#1768B4]';
        return 'bg-[#F0FDF4] text-[#0D7A5F]';
    };
</script>

<template>
    <div class="flex flex-col items-center min-h-screen py-8 px-4">

        <section class="w-full max-w-5xl flex flex-col gap-6">

            <h1 class="text-2xl font-bold lg:text-3xl">Aranceles</h1>

            <!-- TABLA DESKTOP -->
            <div class="hidden md:block bg-white rounded-2xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.08)] overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-[#1C2F5E] text-white">
                        <tr>
                            <th class="text-left px-5 py-3 font-semibold">Tipo</th>
                            <th class="text-left px-5 py-3 font-semibold">Tamaño</th>
                            <th class="text-left px-5 py-3 font-semibold">Monto</th>
                            <th class="text-left px-5 py-3 font-semibold">Período</th>
                            <th class="text-left px-5 py-3 font-semibold">Vigencia</th>
                            <th class="text-left px-5 py-3 font-semibold">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr v-for="a in aranceles" :key="a.id" class="hover:bg-gray-50 transition">
                            <td class="px-5 py-3 font-semibold text-gray-800">{{ a.tipo }}</td>
                            <td class="px-5 py-3">
                                <span :class="['text-xs font-bold px-2 py-1 rounded-full', tamanoClases(a.tamano)]">
                                    {{ a.tamano }}
                                </span>
                            </td>
                            <td class="px-5 py-3 font-black text-[#213779] text-base">Bs. {{ a.monto.toFixed(2) }}</td>
                            <td class="px-5 py-3 text-gray-600">{{ a.periodo }}</td>
                            <td class="px-5 py-3 text-gray-500">{{ a.vigencia }}</td>
                            <td class="px-5 py-3">
                                <button @click="abrirEditar(a)"
                                    class="flex items-center gap-1 text-[#213779] hover:text-[#1a2b5f] font-bold text-xs
                                           border border-[#213779] px-3 py-1 rounded-full hover:bg-[#EBF0FA] transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>
                                    Editar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- CARDS MOBILE -->
            <div class="flex flex-col gap-4 md:hidden">
                <div v-for="a in aranceles" :key="a.id"
                     class="bg-white rounded-xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.08)] p-4">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <p class="font-bold text-gray-800">{{ a.tipo }}</p>
                            <span :class="['text-xs font-bold px-2 py-0.5 rounded-full', tamanoClases(a.tamano)]">{{ a.tamano }}</span>
                        </div>
                        <p class="font-black text-[#213779] text-xl">Bs. {{ a.monto.toFixed(2) }}</p>
                    </div>
                    <div class="text-sm text-gray-500 flex flex-col gap-1">
                        <p>Período: <strong>{{ a.periodo }}</strong></p>
                        <p>Vigencia: <strong>{{ a.vigencia }}</strong></p>
                    </div>
                    <button @click="abrirEditar(a)"
                        class="mt-3 w-full py-2 border-2 border-[#213779] text-[#213779] font-bold rounded-xl
                               hover:bg-[#EBF0FA] transition text-sm">
                        Editar Arancel
                    </button>
                </div>
            </div>

        </section>

        <!-- ─── Modal Editar Arancel ─── -->
        <dialog :open="modalEditar"
            class="fixed inset-0 m-auto w-[90%] max-w-md rounded-2xl shadow-2xl border-none p-0 z-50
                   backdrop:bg-gray-900/60 backdrop:backdrop-blur-sm">
            <div v-if="modalEditar && arancelEdit" class="bg-white rounded-2xl overflow-hidden">

                <div class="bg-[#213779] px-6 py-4 flex items-center justify-between">
                    <p class="text-white font-bold text-lg">Editar Arancel</p>
                    <button @click="modalEditar = false" class="text-white/70 hover:text-white text-2xl leading-none">&times;</button>
                </div>

                <div class="p-6 flex flex-col gap-4">

                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-gray-400 font-semibold text-xs">Tipo</p>
                            <p class="font-bold text-gray-800">{{ arancelEdit.tipo }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-gray-400 font-semibold text-xs">Tamaño</p>
                            <p class="font-bold text-gray-800">{{ arancelEdit.tamano }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-[#404040]">Nuevo Monto (Bs.)</label>
                        <input v-model.number="arancelEdit.monto" type="number" step="0.01" min="0"
                            class="w-full h-10 px-5 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                   focus:border-[#22397A] focus:outline-none text-[#404040] transition font-bold"/>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-[#404040]">Período</label>
                        <input v-model="arancelEdit.periodo" type="text" placeholder="Ej: Ene – Jun 2026"
                            class="w-full h-10 px-5 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                   focus:border-[#22397A] focus:outline-none text-[#404040] transition"/>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-semibold text-[#404040]">Vigencia hasta</label>
                        <input v-model="arancelEdit.vigencia" type="text" placeholder="Ej: 15/06/2026"
                            class="w-full h-10 px-5 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                   focus:border-[#22397A] focus:outline-none text-[#404040] transition"/>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button @click="modalEditar = false"
                            class="flex-1 py-2 border-2 border-gray-300 text-gray-600 font-bold rounded-xl
                                   hover:bg-gray-50 transition duration-200">
                            Cancelar
                        </button>
                        <button @click="guardarEdicion"
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
            :show="exitoEditar"
            text="¡Arancel actualizado correctamente!"
            url="/aranceles-admin"
            title-button="Continuar"
            @close="exitoEditar = false"
        />

    </div>
</template>