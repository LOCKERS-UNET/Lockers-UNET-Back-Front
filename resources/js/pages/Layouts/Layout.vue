<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

    const isMenuOpen = ref(false);

    const openMenu=()=>{

        isMenuOpen.value = !isMenuOpen.value

    }

</script>

<template>

    <div>

        <header class="bg-[#1C2F5E] text-white">
            <nav class=" flex items-center justify-between p-4 max-w-screen-lg mx-auto ">
                
                <div class="flex flex-row gap-10">
                    <button @click="openMenu" class=" block md:hidden cursor-pointer mx-5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                
                    <img src="/img/Logo_Minimal.png" 
                        alt="Logo Minimalista Lockers"
                        class="w-auto h-15 object-contain"
                    >
                </div>

                

                <div class=" hidden gap-10 lg:gap-5 md:flex md:flex-row  text-base lg:text-sm">
                    <Link 
                        href="/home"
                        class=""
                    >Mi Locker</Link>
                    <Link href="/inicio">Menú Inicio</Link>
                    <Link href="/home">Buscar Locker</Link>
                    <Link href="/home">Notificaciones</Link>
                </div>

                
                <div class="flex flex-row gap-5 items-center">
                    <p class=" text-white font-bold text-xl hidden md:block ">
                        ¡Hola, <span class=" text-[#2E7AC0]">{{ $page.props.auth.user.name}}</span>!
                    </p>

                    <Link href="/home">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                            <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z" clip-rule="evenodd" />
                        </svg>


                    </Link>

                    <Link href="/user-profile">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                        </svg>
                    </Link>

                </div>

            </nav>

            <div v-if="isMenuOpen" 
             @click="isMenuOpen = false" 
             class="fixed inset-0 bg-black/50 z-40 md:hidden">
        </div>

        <!-- MENÚ LATERAL (SIDEBAR) -->
        <aside :class="[
            'fixed top-0 left-0 h-full w-64 bg-white z-50 shadow-2xl transform transition-transform duration-300 ease-in-out md:hidden',
            isMenuOpen ? 'translate-x-0' : '-translate-x-full'
        ]">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-[#213779] font-bold text-2xl">Menú</h2>
                    <button @click="isMenuOpen = false" class="text-gray-400 text-3xl">&times;</button>
                </div>

                <nav class="flex flex-col gap-5 text-gray-700 font-medium">
                    <Link href="/" @click="isMenuOpen = false" class="hover:text-blue-600">🏠 Inicio</Link>
                    <Link href="/user-profile" @click="isMenuOpen = false" class="hover:text-blue-600">👤 Mi Perfil</Link>
                    <hr>
                    <Link href="/logout" method="post" as="button" class="text-left text-red-600">🚪 Salir</Link>
                </nav>
            </div>
        </aside>

        </header>

        <main>
            <slot></slot>
        </main>

    </div>

</template>

