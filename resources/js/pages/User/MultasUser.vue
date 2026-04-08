<script setup lang="ts">
    import {Link } from '@inertiajs/vue3';
    import Layout from '../Layouts/Layout.vue';


    defineOptions({layout:Layout});

    defineProps<{
        multa:any
    }>();


</script>

<template> 

    <div class="flex flex-col items-center justify-center py-5">


        <section class=" w-full max-w-3xl flex flex-col gap-5 items-center p-5">

            <h1 class=" text-4xl text-center font-bold mb-5">Multas</h1>

            <section 
                    v-if="multa"
                    class="w-1/2 flex flex-row justify-center items-center shadow-[0px_4px_23px_0px_rgba(0,_0,_0,_0.1)] p-6 rounded-md bg-white "
            >

                <div class="flex flex-col gap-3">
                    
                    <p class="self-center  font-bold flex flex-row gap-2 text-xs sm:block sm:text-base">
                        Monto:
                        <span class="font-normal block text-xs sm:text-base sm:inline"> {{multa.monto}} BS.</span>
                    </p>

                    <p class="self-center font-bold flex flex-row gap-2 text-xs sm:block sm:text-base">
                        Motivo:
                        <span class="font-normal block text-xs sm:text-base sm:inline">{{multa.descripcion}}</span>
                    </p>
                    
                </div>

            </section>

            <section 

                v-else
                class="flex flex-row justify-between items-center shadow-[0px_4px_23px_0px_rgba(0,_0,_0,_0.1)] p-6 rounded-md bg-white "
            >
                El usuario no posee Multas
            </section>

            <div class=" w-full flex flex-col gap-7">

                <h2 class=" text-xl sm:text-3xl font-bold text-[#4169C4]">
                    Direccion
                </h2>

                <hr>

                <h3 
                    class="self-center font-bold text-sm sm:text-lg"
                >
                    Decanato de Desarrollo Estudiantil
                </h3>

                <hr>


                <p class="self-center flex flex-row font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                    </svg>

                    <span class="text-base font-normal">8:00am - 2:00pm</span>

                </p>

                <Link 
                    href="/"
                    class="self-center bg-[#22397A] py-1 px-3 text-white text-lg font-bold rounded-lg"
                >

                    Entendido

                </Link>

            </div>

        </section>

        
    </div>

</template>