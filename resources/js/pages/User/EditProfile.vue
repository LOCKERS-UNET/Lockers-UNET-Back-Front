<script setup lang="ts">
    import { router } from '@inertiajs/vue3';
    import { reactive } from 'vue';
    import Layout from '../Layouts/Layout.vue';


    defineOptions({layout:Layout});

    defineProps({errors:Object});

    const form = reactive ({

        name: null,
        lastname: null,
        email:null,
        card_code:null,
        career:null

    })

    const submit = ()=>{

        router.post('/edit-profile',form);

    }


</script>

<template> 

    <div class="flex flex-col items-center justify-center min-h-screen py-8">


        <section class=" w-full max-w-3xl flex flex-col">

            <h1 class=" text-4xl text-center font-bold mb-5">Editar Perfil</h1>

            <form @submit.prevent="submit" class="flex flex-col gap-5">

                <div class="space-y-2 min-h-16">
                    <label for="name" class="block text-[#404040] font-semibold ml-1">
                        Nombre
                    </label>
                    <input 
                        type="text"
                        name="name" 
                        id="name"
                        placeholder="Ingresa tu Nombre"
                        class="w-full h-10 px-5 py-3 rounded-full bg-gray-100  border-3 border-[#E5E5E5]  focus:bg-white focus:outline-none text-[#404040] transition duration-200
                            placeholder:font-bold placeholder:text-[#A3A3A3] placeholder:text-sm"
                        :class="{
                            'border-[#DC2626]  bg-[#FEE2E2]': errors?.name, 
                            'border-[#A3A3A3] focus:border-[#22397A]': !errors?.name
                        }"
                        v-model="form.name"
                    >
                    <!-- <small v-if="errors?.name" class="text-red-500">{{ errors.name }}</small> -->
                </div>

                <div class="space-y-2 min-h-16">
                    <label for="lastname" class="block text-[#404040] font-semibold ml-1">
                        Apellido
                    </label>
                    <input 
                        type="text"
                        name="lastname" 
                        id="lastname"
                        placeholder="Ingresa tu Apellido"
                        class="w-full h-10 px-5 py-3 rounded-full bg-gray-100  border-3 border-[#E5E5E5] focus:bg-white focus:outline-none text-[#404040] transition duration-200
                            placeholder:font-bold placeholder:text-[#A3A3A3] placeholder:text-sm"
                        :class="{
                            'border-[#DC2626]  bg-[#FEE2E2]': errors?.lastname, 
                            'border-[#A3A3A3] focus:border-[#22397A]': !errors?.lastname
                        }"
                        v-model="form.lastname"
                    >
                    <!-- <small v-if="errors?.lastname" class="text-red-500">{{ errors.lastname }}</small> -->
                </div>

                <div class="space-y-2 min-h-16">
                    <label for="email" class="block text-[#404040] font-semibold ml-1">
                        Correo
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        name="email"
                        placeholder="Ingresa tu correo UNET"
                        class="w-full h-10 px-5 py-3 rounded-full bg-gray-100 border-3 border-[#E5E5E5] focus:bg-white focus:outline-none text-[#404040] transition duration-200
                            placeholder:font-bold placeholder:text-[#A3A3A3] placeholder:text-sm"
                        :class="{
                            'border-[#DC2626]  bg-[#FEE2E2]': errors?.email, 
                            'border-[#E5E5E5] focus:border-[#22397A]': !errors?.email
                        }"
                        v-model="form.email"   
                    >
                    <small v-if="errors?.email" class="text-red-500 font-bold">{{ errors.email }}</small>
                </div>

                <div class="space-y-2 min-h-16">
                    <label for="card_code" class="block text-[#404040] font-semibold ml-1">
                        Código Carnet 
                    </label>
                    <input 
                        type="number" 
                        id="card_code"
                        name="card_code"
                        placeholder="Carnet de 5 dígitos UNET"
                        class="w-full h-10 px-5 py-3 rounded-full bg-gray-100 border-3 border-[#E5E5E5] focus:bg-white focus:outline-none text-[#404040] transition duration-200
                            placeholder:font-bold placeholder:text-[#A3A3A3] placeholder:text-sm"
                        :class="{
                            'border-[#DC2626]  bg-[#FEE2E2]': errors?.password, 
                            'border-[#A3A3A3] focus:border-[#22397A]': !errors?.password
                        }"
                        v-model="form.card_code"
                    >
                    <!-- <small v-if="errors?.password" class="text-red-500">{{ errors.password }}</small> -->
                </div>

                <div class="space-y-2 min-h-16">
                    <label for="career" class="block text-[#404040] font-semibold ml-1">
                        Carrera
                    </label>
                    <input 
                        type="text" 
                        id="career"
                        name="career"
                        placeholder="Confirma tu contraseña"
                        class="w-full h-10 px-5 py-3 rounded-full bg-gray-100  border-3 border-[#E5E5E5]
                            focus:border-[#22397A] focus:bg-white focus:outline-none text-[#404040] transition duration-200
                            placeholder:font-bold placeholder:text-[#A3A3A3] placeholder:text-sm"
                        
                        v-model="form.career"
                    >
                    
                </div>

                <div class="pt-4 flex justify-center">
                    <button 
                        type="submit"
                        class="w-1/2 py-3 bg-[#213779] hover:bg-[#1a2b5f] text-white font-bold rounded-xl transition duration-300 shadow-md active:scale-95"
                    >
                        Guardar Cambios
                    </button>
                </div>

            </form>


        </section>

    </div>

</template>