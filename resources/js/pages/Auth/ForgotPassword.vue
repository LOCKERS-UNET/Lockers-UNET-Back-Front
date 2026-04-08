<script setup lang="ts">
    import { Link, router } from '@inertiajs/vue3';
    import { reactive } from 'vue';

    const form = reactive({
        email: null as string | null,
    });

    const submit = () => {
        // TODO: conectar con backend
        router.get('/verify-code');
    };
</script>

<template>
    <section class="min-h-screen flex flex-col bg-white">

        <header class="hidden lg:flex lg:justify-between lg:items-center lg:w-full lg:p-6">
            <img src="/img/Logo_Lockers_UNET.png" alt="logo lockers unet" class="h-12 md:h-20 w-auto object-contain">
            <img src="/img/Logo_UNET.png" alt="Logo unet" class="h-12 md:h-20 w-auto object-contain">
        </header>

        <main class="flex-grow flex items-center justify-center p-4">

            <div class="flex flex-col lg:flex-row w-full max-w-6xl items-center justify-center gap-10 md:gap-24">

                <!-- Imagen / Logo -->
                <div class="flex-shrink-0">
                    <img src="/img/Logo_Lockers_UNET.png"
                         alt="logo lockers"
                         class="block lg:hidden h-auto max-h-[100px] w-auto object-contain"
                    >
                    <img src="/img/Login.png"
                         alt="ilustración"
                         class="hidden lg:block h-auto max-h-[300px] w-auto object-contain"
                    >
                </div>

                <!-- Formulario -->
                <div class="w-full max-w-md bg-white p-2">

                    <!-- Ícono de candado -->
                    <div class="flex justify-center mb-4">
                        <div class="bg-[#EBF0FA] rounded-full p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#213779" class="size-10">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">¿Olvidaste tu contraseña?</h2>
                    <p class="text-center text-gray-500 text-sm mb-8">
                        Ingresa tu correo y te enviaremos un código de verificación.
                    </p>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div class="space-y-2">
                            <label for="email" class="block text-[#404040] font-semibold ml-1">Correo</label>
                            <input
                                type="email"
                                id="email"
                                placeholder="Ingresa tu correo UNET"
                                class="w-full h-10 px-5 py-3 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                       focus:border-[#22397A] focus:bg-white focus:outline-none text-[#404040]
                                       transition duration-200 placeholder:font-bold placeholder:text-[#A3A3A3] placeholder:text-sm"
                                v-model="form.email"
                            >
                        </div>

                        <div class="pt-2 flex justify-center">
                            <button
                                type="submit"
                                class="w-full py-3 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold rounded-xl
                                       transition duration-300 shadow-md active:scale-95"
                            >
                                Enviar Código
                            </button>
                        </div>

                        <p class="text-center text-gray-600 mt-4">
                            <Link href="/login" class="text-blue-500 font-semibold hover:underline flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                                    <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                                </svg>
                                Volver al inicio de sesión
                            </Link>
                        </p>
                    </form>
                </div>

            </div>
        </main>
    </section>
</template>