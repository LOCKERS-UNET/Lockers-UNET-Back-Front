<script setup lang="ts">

    import {Link} from '@inertiajs/vue3';
    import LayoutAdmin from '../Layouts/LayoutAdmin.vue';   
    
    interface User {

        name: string;
        lastname: string;
        email: string;
        card_code: string;
        career: string;

    }

    defineProps<{
        user: User;
    }>();

    defineOptions({layout: LayoutAdmin})

</script>

<template>
        <!-- Contenedor principal con un ancho máximo definido -->
    <div class="flex flex-col items-center justify-center min-h-screen py-8"> 
        
        <!-- Envolvemos todo en un div que controle el ancho de las secciones -->
        <div class="w-full max-w-3xl flex flex-col gap-8 px-4">

            <!-- SECCIÓN PERFIL -->
            <div class="flex flex-col gap-4">
                <h1 class="text-3xl font-bold text-center">Usuario <span class="text-[#2E7AC0]">{{ user.name }}</span></h1> 

                <section class="flex flex-col gap-3">
                    <div class="flex flex-col w-full sm:flex-row items-center gap-10 md:gap-20 shadow-[0px_4px_23px_0px_rgba(0,_0,_0,_0.1)] p-6 rounded-md bg-white justify-center-safe">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-40 shrink-0">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>

                        <div class="flex flex-col gap-2 overflow-hidden ">
                            <p class="font-bold flex flex-row gap-2 text-sm sm:block sm:text-base">
                                Nombre Usuario: 
                                <span class="font-normal block sm:inline">{{ user.name }} {{ user.lastname }}</span>
                            </p>
                            <p class="font-bold flex flex-row gap-2 text-sm sm:block sm:text-base">
                                Código Carnet: 
                                <span class="font-normal block sm:inline">{{ user.card_code }}</span>
                            </p>
                            <p class="font-bold flex flex-row gap-2 text-sm sm:block sm:text-base">
                                Carrera: 
                                <span class="font-normal block sm:inline">{{ user.career }}</span>
                            </p>
                            <p class="font-bold flex flex-row gap-2 text-sm sm:block sm:text-base">
                                Correo: 
                                <span class="font-normal block sm:inline break-all">{{ user.email }}</span>
                            </p>
                            <p class="font-bold flex flex-row gap-2 text-sm sm:block sm:text-base">
                                Locker: 
                                <span class="font-normal block sm:inline break-all">xxxxxxxx</span>
                            </p>
                            <p class="font-bold flex flex-row gap-2 text-sm sm:block sm:text-base">
                                Edificio: 
                                <span class="font-normal block sm:inline break-all">xxxxxx</span>
                            </p>
                            
                        </div>
                    </div>

                    <Link :href="`/admin/multas/${user.card_code}`" as="button" class="self-end flex flex-row  px-6 py-2 items-center justify-center gap-2 bg-[#DC2626] rounded-md">
                        <p class=" text-white font-bold  transition-colors text-sm">
                            Añadir Multa
                        </p>
 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-6">
                            <path fill-rule="evenodd" d="M11.484 2.17a.75.75 0 0 1 1.032 0 11.209 11.209 0 0 0 7.877 3.08.75.75 0 0 1 .722.515 12.74 12.74 0 0 1 .635 3.985c0 5.942-4.064 10.933-9.563 12.348a.749.749 0 0 1-.374 0C6.314 20.683 2.25 15.692 2.25 9.75c0-1.39.223-2.73.635-3.985a.75.75 0 0 1 .722-.516l.143.001c2.996 0 5.718-1.17 7.734-3.08ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75ZM12 15a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75H12Z" clip-rule="evenodd" />
                        </svg>


                    </Link> 
                </section>
            </div>

            <!-- SECCIÓN LOCKER -->
            <div class="flex flex-col gap-4">
                <h2 class="text-[#4169C4] text-2xl font-bold">Información Locker</h2> 

                <section class="flex flex-col gap-3 ">
                    <div class="grid grid-cols-2 gap-6 shadow-[0px_4px_23px_0px_rgba(0,_0,_0,_0.1)] p-6 rounded-md bg-white ">
                        <div class="flex flex-col gap-2 items-center">
            
                            <p class="font-bold text-sm sm:text-base">
                                ID Locker: 
                                <span class="font-normal">142</span>
                            </p>
                            <p class="font-bold text-sm sm:text-base">
                                Código: 
                                <span class="font-normal break-all">B-142</span>
                            </p>
                        </div>

                        <div class="flex flex-col gap-2 items-center">
                            
                            <p class="font-bold text-sm sm:text-base">
                                Tamaño: 
                                <span class="font-normal">Mediano</span>
                            </p>
                            <p class="font-bold text-sm sm:text-base">
                                Edificio: <span class="font-normal">B - Piso 1</span>
                            </p>
                        </div>
                    </div>

                    <Link href="/logout" method="post" as="button" class="self-end">
                        <p class="bg-[#DC2626] text-white px-6 py-2 rounded-md hover:bg-red-700 transition-colors text-sm font-medium">
                            Cerrar Sesión
                        </p>
                    </Link>
                </section>
            </div>

        </div>
    </div>
</template>