<script setup lang="ts">
    import { Link, router } from '@inertiajs/vue3';
    import { reactive, ref } from 'vue';

    defineProps({ errors: Object });

    const form = reactive({
        password: null as string | null,
        password_confirmation: null as string | null,
    });

    const showPassword = ref(false);
    const showConfirm  = ref(false);

    const submit = () => {
        // TODO: conectar con backend
        router.get('/login');
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

                <!-- Imagen -->
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

                    <div class="flex justify-center mb-4">
                        <div class="bg-[#EBF0FA] rounded-full p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#213779" class="size-10">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <h2 class="text-3xl font-bold text-gray-800 text-center mb-2">Nueva Contraseña</h2>
                    <p class="text-center text-gray-500 text-sm mb-8">
                        Crea una contraseña segura para tu cuenta.
                    </p>

                    <form @submit.prevent="submit" class="space-y-6">

                        <!-- Nueva contraseña -->
                        <div class="space-y-2">
                            <label for="password" class="block text-[#404040] font-semibold ml-1">Nueva Contraseña</label>
                            <div class="relative">
                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    id="password"
                                    placeholder="Ingresa tu nueva contraseña"
                                    class="w-full h-10 px-5 py-3 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                           focus:border-[#22397A] focus:bg-white focus:outline-none text-[#404040]
                                           transition duration-200 placeholder:font-bold placeholder:text-[#A3A3A3] placeholder:text-sm pr-12"
                                    :class="{
                                        'border-[#DC2626] bg-[#FEE2E2]': errors?.password,
                                        'border-[#A3A3A3] focus:border-[#22397A]': !errors?.password
                                    }"
                                    v-model="form.password"
                                >
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577A11.217 11.217 0 0 1 12 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                        <path d="M15.75 12c0 .18-.013.357-.037.53l-4.244-4.243A3.75 3.75 0 0 1 15.75 12ZM10.5 16.5a5.147 5.147 0 0 1-1.125-.126l-1.872-1.872A3.75 3.75 0 0 0 12 15.75c.293 0 .58-.032.856-.094l-1.875-1.875A3.736 3.736 0 0 1 10.5 13.5v-.001l-2.37-2.37a5.25 5.25 0 0 0 2.37 5.37Z" />
                                    </svg>
                                </button>
                            </div>
                            <small v-if="errors?.password" class="text-red-500">{{ errors.password }}</small>
                        </div>

                        <!-- Confirmar contraseña -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-[#404040] font-semibold ml-1">Confirmar Contraseña</label>
                            <div class="relative">
                                <input
                                    :type="showConfirm ? 'text' : 'password'"
                                    id="password_confirmation"
                                    placeholder="Confirma tu nueva contraseña"
                                    class="w-full h-10 px-5 py-3 rounded-full bg-gray-100 border-2 border-[#A3A3A3]
                                           focus:border-[#22397A] focus:bg-white focus:outline-none text-[#404040]
                                           transition duration-200 placeholder:font-bold placeholder:text-[#A3A3A3] placeholder:text-sm pr-12"
                                    v-model="form.password_confirmation"
                                >
                                <button type="button" @click="showConfirm = !showConfirm"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500">
                                    <svg v-if="!showConfirm" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                    </svg>
                                    <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                        <path d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM22.676 12.553a11.249 11.249 0 0 1-2.631 4.31l-3.099-3.099a5.25 5.25 0 0 0-6.71-6.71L7.759 4.577A11.217 11.217 0 0 1 12 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="pt-2 flex justify-center">
                            <button
                                type="submit"
                                class="w-full py-3 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold rounded-xl
                                       transition duration-300 shadow-md active:scale-95"
                            >
                                Guardar Contraseña
                            </button>
                        </div>

                        <p class="text-center text-gray-600">
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
