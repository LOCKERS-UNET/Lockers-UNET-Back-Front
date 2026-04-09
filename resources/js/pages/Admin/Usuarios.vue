<script setup lang="ts">

    import { router,Link } from '@inertiajs/vue3';
    import debounce from 'lodash/debounce';

    import { watch, ref  } from 'vue';
    import LayoutAdmin from '../Layouts/LayoutAdmin.vue';

    const props = defineProps<{
        users:any,
        filters:any
    }>();

    const search = ref(props.filters?.search ?? '');

    defineOptions({layout:LayoutAdmin})

    watch(search, debounce((value)=>{
        router.get('/admin/buscar', 
            {search: value},
            {
                replace: true,
                preserveState: true
            }
        );
    },300))
    

</script>


<template>


    <div class="flex flex-col items-center justify-center gap-8 py-5">

        <h1 class=" text-4xl font-bold">
            Usuarios
        </h1>

        <div class="relative w-1/2 sm:w-2/5">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>

            </div>
            <input 
                type="text" 
                v-model="search"
                id="search" 
                name="search"
                class="block w-full p-3 ps-9 rounded-lg border-2 border-[#A3A3A3] outline-none focus:border-[#22397A]
                 placeholder:font-bold placeholder:text-[#A3A3A3] placeholder:text-sm" 
                placeholder="Nombre Usuario..."
            />

        </div>


        <p class="text-[#4169C4] font-bold">Visualizacion de Usuarios</p>

        <div v-for="user in users" :key="user.id" class=" w-3/4 lg:w-1/2 flex flex-col gap-3">

            <div class=" flex flex-col rounded-lg bg-[#D6E4F7] px-5 py-2 gap-3">
                <div class="">
                    <p 
                        class="mb-2 font-bold text-sm sm:text-lg lg:text-xl "
                    >
                        {{ user.name }} {{ user.lastname }}
                    </p>
                    <hr>
                </div>
                

                <div class=" flex flex-col gap-1">

                    <p class="font-bold text-xs sm:text-sm lg:text-base">
                        Locker:
                        <span class="font-normal">
                            002
                        </span>
                    </p>

                    <p class="font-bold text-xs sm:text-sm lg:text-base">
                        Edificio
                        <span class="font-normal">
                            A
                        </span>
                    </p>

                    <div class="flex flex-row justify-between items-center">
                        <p class="font-bold text-xs sm:text-sm lg:text-base">
                            Rol:
                            <span class="font-normal">
                                {{ user.is_admin === 1? `Admin` : `Usuario` }}
                            </span>
                        </p>

                        <Link 
                            :href="`/admin/buscar/${user.card_code}`"
                            class="px-1 bg-[#1C2F5E] text-white text-center font-bold rounded-lg text-xs w-[50px]  md:w-[100px] md:px-2 sm:w-[80px] sm:text-base">

                            Ver

                        </Link>

                    </div>
                    

                </div>
                    
                
            </div>


        </div>

    </div>


    

</template>