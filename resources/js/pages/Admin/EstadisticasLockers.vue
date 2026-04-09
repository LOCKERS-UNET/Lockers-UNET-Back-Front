<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import LayoutAdmin from '../Layouts/LayoutAdmin.vue';

defineOptions({ layout: LayoutAdmin });

// Datos mockeados para los filtros y resultados
const carreras = ['Informática', 'Industrial', 'Civil', 'Electrónica', 'Mecánica'];
const semestres = ['2025-2', '2026-1'];

const filtroCarrera = ref('');
const filtroSemestre = ref('');
const filtroMes = ref('Marzo 2026');

// Resultados de la gráfica (Cajitas)
const kpis = [
    { label: 'Uso Proyectado', value: '150', color: 'bg-[#1768B4]' },
    { label: 'Capacidad Total', value: '800', color: 'bg-[#DC2626]' },
    { label: 'Crecimiento Mensual', value: '+12%', color: 'bg-[#0D7A5F]' },
    { label: 'Tasa de Ocupación', value: '18.7%', color: 'bg-[#F97316]' }
];
</script>

<template>
    <Head title="Estadísticas de Lockers" />
    <main class="py-10 px-4 sm:px-10">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl lg:text-4xl font-extrabold text-black mb-10">Estadísticas Lockers</h1>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-10 items-end">
                <div class="flex flex-col gap-2">
                    <label class="font-bold text-sm">Carrera</label>
                    <select v-model="filtroCarrera" class="border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#213779] outline-none">
                        <option value="">Todas las carreras</option>
                        <option v-for="c in carreras" :key="c" :value="c">{{ c }}</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="font-bold text-sm">Semestre</label>
                    <select v-model="filtroSemestre" class="border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#213779] outline-none">
                        <option v-for="s in semestres" :key="s" :value="s">{{ s }}</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="font-bold text-sm">Mes</label>
                    <select v-model="filtroMes" class="border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-[#213779] outline-none">
                        <option value="Marzo 2026">Marzo 2026</option>
                        <option value="Abril 2026">Abril 2026</option>
                    </select>
                </div>
                <button class="bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold p-3 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-md">
                    <span>Filtrar</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 0 1 .628.74v2.288a2.25 2.25 0 0 1-.659 1.59l-4.682 4.683a2.25 2.25 0 0 0-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 0 1 8 18.25v-5.757a2.25 2.25 0 0 0-.659-1.591L2.659 6.22A2.25 2.25 0 0 1 2 4.629V2.34a.75.75 0 0 1 .628-.74Z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                <div class="w-full lg:w-3/4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                    <h3 class="text-center font-bold text-gray-600 mb-4">Proyección Exponencial de Uso de Lockers - {{ filtroMes }}</h3>
                    <div class="aspect-video w-full flex items-center justify-center border-l-2 border-b-2 border-gray-200 relative">
                        <svg viewBox="0 0 400 200" class="w-full h-full overflow-visible">
                            <line x1="0" y1="40" x2="400" y2="40" stroke="#DC2626" stroke-width="2" stroke-dasharray="4" />
                            <path d="M 0 190 Q 200 185, 400 140" fill="none" stroke="#1768B4" stroke-width="4" />
                            <text x="310" y="130" class="text-[10px] font-bold fill-black">150 lockers</text>
                        </svg>
                        
                        <div class="absolute -left-10 top-1/2 -rotate-90 text-[10px] text-gray-400 font-bold">Número de Lockers</div>
                        <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] text-gray-400 font-bold">Día del Mes</div>
                    </div>
                    
                    <div class="flex justify-center gap-6 mt-6">
                        <div class="flex items-center gap-2 text-xs font-bold">
                            <span class="w-4 h-1 bg-[#1768B4]"></span> Uso Proyectado
                        </div>
                        <div class="flex items-center gap-2 text-xs font-bold">
                            <span class="w-4 h-0.5 border-t-2 border-dashed border-[#DC2626]"></span> Capacidad Total (800 lockers)
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/4 grid grid-cols-1 gap-4">
                    <div v-for="kpi in kpis" :key="kpi.label" 
                        class="p-5 rounded-2xl shadow-md transition-transform hover:scale-105"
                        :class="kpi.color">
                        <p class="text-white/80 text-xs font-bold uppercase tracking-wider">{{ kpi.label }}</p>
                        <p class="text-white text-3xl font-black mt-1">{{ kpi.value }}</p>
                    </div>
                </div>

            </div>
        </div>
    </main>
</template>