<script setup lang="ts">
    import { ref } from 'vue';
    import Layout from '../Layouts/Layout.vue';
    import ModalComponent from '../Components/ModalComponent.vue';

    defineOptions({ layout: Layout });

    // ── Datos mockeados ────────────────────────────────────────────────────
    const arancel = {
        locker: 'B-142',
        periodo: 'Enero – Junio 2026',
        monto: 50.00,
        vencimiento: '15/04/2026',
        estado: 'Pendiente',
    };

    const exitoModal = ref(false);
    const procesando = ref(false);

    const pagar = () => {
        procesando.value = true;
        // Simulación de procesamiento
        setTimeout(() => {
            procesando.value = false;
            exitoModal.value = true;
        }, 1200);
    };
</script>

<template>
    <div class="flex flex-col items-center min-h-screen py-8 px-4">

        <section class="w-full max-w-2xl flex flex-col gap-6">

            <h1 class="text-2xl font-bold lg:text-3xl text-center">Pago de Arancel</h1>

            <!-- Tarjeta de resumen -->
            <div class="bg-white rounded-2xl shadow-[0px_4px_23px_0px_rgba(0,0,0,0.1)] overflow-hidden">

                <!-- Header de la tarjeta -->
                <div class="bg-[#213779] px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-6">
                            <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-white font-bold text-lg">Resumen de Pago</p>
                    </div>
                    <span class="bg-[#FEE2E2] text-[#DC2626] text-xs font-bold px-3 py-1 rounded-full">
                        {{ arancel.estado }}
                    </span>
                </div>

                <!-- Detalle del arancel -->
                <div class="p-6 flex flex-col gap-4">

                    <div class="flex flex-col gap-3 divide-y divide-gray-100">
                        <div class="flex justify-between items-center pt-2 first:pt-0">
                            <span class="text-gray-500 text-sm font-semibold">Locker</span>
                            <span class="font-black text-[#213779]">{{ arancel.locker }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-3">
                            <span class="text-gray-500 text-sm font-semibold">Período</span>
                            <span class="font-bold text-gray-800 text-sm">{{ arancel.periodo }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-3">
                            <span class="text-gray-500 text-sm font-semibold">Vencimiento</span>
                            <span class="font-bold text-gray-800 text-sm">{{ arancel.vencimiento }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-3">
                            <span class="text-gray-500 text-sm font-semibold">Monto Total</span>
                            <span class="font-black text-2xl text-[#213779]">Bs. {{ arancel.monto.toFixed(2) }}</span>
                        </div>
                    </div>

                    <!-- Aviso -->
                    <div class="bg-[#FEF9C3] border border-[#FDE047] rounded-xl p-3 flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#92400E" class="size-5 shrink-0 mt-0.5">
                            <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-xs text-[#92400E] font-semibold leading-relaxed">
                            El arancel debe pagarse antes del vencimiento para evitar multas o la suspensión del casillero.
                        </p>
                    </div>

                    <!-- Método de pago (visual) -->
                    <div class="flex flex-col gap-2">
                        <p class="text-sm font-bold text-gray-700">Método de Pago</p>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <label class="flex items-center gap-3 border-2 border-[#213779] rounded-xl p-3 flex-1 cursor-pointer">
                                <input type="radio" name="metodo" value="efectivo" checked class="accent-[#213779]">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#213779" class="size-5">
                                        <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z" />
                                        <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z" clip-rule="evenodd" />
                                        <path d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z" />
                                    </svg>
                                    <span class="text-sm font-bold text-[#213779]">Efectivo</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 border-2 border-gray-200 rounded-xl p-3 flex-1 cursor-pointer">
                                <input type="radio" name="metodo" value="transferencia" class="accent-[#213779]">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="gray" class="size-5">
                                        <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                                        <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-bold text-gray-600">Transferencia</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Botón de pago -->
                    <button
                        @click="pagar"
                        :disabled="procesando"
                        class="w-full py-3 bg-[#213779] hover:bg-[#1a2b5f] disabled:opacity-60 text-white font-bold
                               rounded-xl transition duration-300 shadow-md active:scale-95 flex items-center justify-center gap-2"
                    >
                        <svg v-if="procesando" class="animate-spin size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        <span>{{ procesando ? 'Procesando...' : 'Confirmar Pago' }}</span>
                    </button>

                </div>
            </div>

        </section>

        <!-- Modal de éxito -->
        <ModalComponent
            :show="exitoModal"
            text="¡Pago realizado correctamente!"
            url="/mi-locker"
            title-button="Ver mi Locker"
            @close="exitoModal = false"
        />

    </div>
</template>
