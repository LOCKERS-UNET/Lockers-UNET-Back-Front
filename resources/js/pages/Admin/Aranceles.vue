<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import LayoutAdmin from '../Layouts/LayoutAdmin.vue';

defineOptions({ layout: LayoutAdmin });

// ── Estado ──
const isEditing = ref(false);
const arancelToEdit = ref<any>(null);

const aranceles = ref([
    { id: 1, tamano: 'Pequeño', monto: 2500, desde: 'Marzo 2026' },
    { id: 2, tamano: 'Mediano', monto: 4000, desde: 'Marzo 2026' },
    { id: 3, tamano: 'Grande', monto: 6000, desde: 'Marzo 2026' }
]);

const editArancel = (arancel: any) => {
    arancelToEdit.value = { ...arancel };
    isEditing.value = true;
};

const cancelarEdicion = () => {
    isEditing.value = false;
    arancelToEdit.value = null;
};

const guardarEdicion = () => {
    // Aquí en el futuro se enviará por Axios/Inertia a Laravel
    const index = aranceles.value.findIndex(a => a.id === arancelToEdit.value.id);

    if(index !== -1) {
        aranceles.value[index].monto = arancelToEdit.value.monto;
    }

    isEditing.value = false;
    arancelToEdit.value = null;
    alert("¡Arancel actualizado visualmente!");
};
</script>

<template>
    <Head title="Aranceles" />
    <div class="min-h-screen bg-white py-12 px-4 flex justify-center">

        <!-- ── VISTA 1: Lista de Aranceles ── -->
        <div v-if="!isEditing" class="w-full max-w-2xl flex flex-col items-center">
            
            <h1 class="text-3xl sm:text-4xl font-extrabold text-black mb-8 mt-4">Aranceles</h1>
            <h2 class="text-lg sm:text-xl font-black text-[#4472c4] mb-12">Montos mensuales por tamaño</h2>

            <div class="w-full max-w-[500px] flex flex-col gap-6">
                <!-- Tarjeta Arancel Iterable -->
                <div v-for="a in aranceles" :key="a.id" class="w-full border border-gray-200 shadow-[0px_4px_15px_rgba(0,0,0,0.06)] rounded-sm pt-6 pb-4 px-6 flex flex-col sm:flex-row justify-between items-center bg-white gap-4">
                    
                    <!-- Datos Lado Izquierdo -->
                    <div class="flex flex-col text-center sm:text-left">
                        <p class="font-extrabold text-black text-sm mb-1">{{ a.tamano }}</p>
                        <p class="text-[#213779] font-black text-xl sm:text-2xl mb-1">Bs. {{ a.monto }}</p>
                        <p class="text-gray-400 text-[11px] font-semibold">Por mes</p>
                    </div>

                    <!-- Botón Lado Derecho -->
                    <div class="flex flex-col items-center w-full sm:w-[160px]">
                        <button @click="editArancel(a)" class="w-full py-2 bg-[#213779] hover:bg-[#1a2b5f] text-white font-extrabold text-xs rounded-full shadow-md transition-colors active:scale-95 mb-2 sm:mb-4">
                            Editar
                        </button>
                        <p class="text-gray-400 text-[11px] sm:text-xs font-semibold">Desde {{ a.desde }}</p>
                    </div>

                </div>
            </div>

        </div>

        <!-- ── VISTA 2: Editar Arancel ── -->
        <div v-else class="w-full max-w-2xl flex flex-col items-center">
            
            <h1 class="text-3xl sm:text-4xl font-extrabold text-black mb-8 mt-4">Editar Arancel</h1>
            <h2 class="text-lg sm:text-xl font-extrabold text-[#4472c4] mb-10">Locker {{ arancelToEdit.tamano }}</h2>

            <!-- Bloque de Info Actual -->
            <div class="w-full max-w-lg bg-[#e4ebf7] rounded-sm p-8 mb-10 flex flex-col gap-6">
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-12">
                    <span class="font-extrabold text-black text-sm min-w-[120px] ml-4">Monto actual</span>
                    <span class="text-gray-600 text-sm font-semibold ml-4 sm:ml-0">{{ arancelToEdit.monto }} Bs./mes</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-12">
                    <span class="font-extrabold text-black text-sm min-w-[120px] ml-4">Vigente desde</span>
                    <span class="text-gray-600 text-sm font-semibold ml-4 sm:ml-0">{{ arancelToEdit.desde }}</span>
                </div>
            </div>

            <!-- Formularios -->
            <div class="w-full max-w-lg flex flex-col gap-8 mb-12">
                <!-- Nuevo Monto Input -->
                <div class="flex flex-col gap-2">
                    <label class="font-extrabold text-black text-sm ml-2">Nuevo monto mensual (Bs.)</label>
                    <input type="number" v-model="arancelToEdit.monto" placeholder="Ingrese el nuevo arancel" class="w-full h-12 px-6 bg-[#f3f4f6] border border-gray-100 rounded-xl text-sm font-bold text-black placeholder:font-semibold placeholder:text-gray-400 focus:bg-white focus:outline-none focus:border-gray-300 transition-colors shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]" />
                </div>
                <!-- Motivo Input -->
                <div class="flex flex-col gap-2">
                    <label class="font-extrabold text-black text-sm ml-2">Motivo del cobro</label>
                    <input type="text" placeholder="Ingrese el motivo del aumento del arancel" class="w-full h-12 px-6 bg-[#f3f4f6] border border-gray-100 rounded-xl text-sm font-bold text-black placeholder:font-semibold placeholder:text-gray-400 focus:bg-white focus:outline-none focus:border-gray-300 transition-colors shadow-[inset_0_2px_4px_rgba(0,0,0,0.03)]" />
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="w-full max-w-[400px] flex gap-4 sm:gap-6 justify-center">
                <button @click="cancelarEdicion" class="flex-1 py-3 text-[#213779] bg-white border border-[#213779] font-extrabold rounded-xl hover:bg-gray-50 transition active:scale-95 shadow-sm text-sm">
                    Cancelar
                </button>
                <button @click="guardarEdicion" class="flex-1 py-3 text-white bg-[#213779] hover:bg-[#1a2b5f] font-extrabold rounded-xl transition active:scale-95 shadow-md text-sm">
                    Guardar
                </button>
            </div>

        </div>

    </div>
</template>