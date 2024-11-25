<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import "animate.css";
import { ref } from "vue";

defineProps({
    pages: Number,
    domains: Number,
    verifyWithErrors: Number,
    lastVerify: String,
});

const propaganda = ref(true);

const closeModal = () => {
    propaganda.value = false;
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-[#1d1d1d]"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mx-auto grid grid-cols-3 gap-2">
                            <div class="bg-[#111] overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="md:p-6 p-2 text-gray-900">
                                    <h3
                                        class="text-amber-500 md:text-2xl sm:text-lg font-semibold"
                                    >
                                        Domínios Sob Alerta
                                    </h3>
                                    <p class="md:text-xl sm:text-sm mt-1">
                                        <span class="mr-2 text-white">{{ domains }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="bg-[#111] overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="md:p-6 p-2 text-gray-900">
                                    <h3
                                        class="text-green-500 md:text-2xl sm:text-lg font-semibold"
                                    >
                                        Páginas Sem Problemas
                                    </h3>
                                    <p class="md:text-xl sm:text-sm mt-1">
                                        <span class="mr-2 text-white">{{ pages }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="bg-[#111] overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="md:p-6 p-2 text-gray-900">
                                    <h3
                                        class="text-red-500 md:text-2xl sm:text-lg font-semibold"
                                    >
                                        Páginas com Problemas
                                    </h3>
                                    <p class="md:text-xl sm:text-sm mt-1">
                                        <span class="mr-2 text-white">{{ verifyWithErrors }}</span>
                                    </p>
                                </div>
                            </div>

                            <h1 class="animate__animated animate__flash">
                                Última Verificação em: {{ lastVerify }}
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- Propaganda Modal -->
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-[#1d1d1d] mt-5"
                    v-if="propaganda"
                >
                    <div
                        class="flex flex-row-reverse cursor-pointer"
                        @click="closeModal"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            style="fill: rgba(255, 255, 255, 0.6);"
                        >
                            <path
                                d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"
                            ></path>
                        </svg>
                    </div>
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-bold text-blue-500 mb-4">
                            Transforme sua Ideia em um Site Incrível!
                        </h2>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-3">
                            Você sonha com um site moderno, funcional e que impressione seus visitantes? Nós podemos ajudar!
                        </p>
                        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300 mb-4">
                            <li>Sites personalizados que destacam sua marca.</li>
                            <li>Design responsivo para dispositivos móveis.</li>
                            <li>Otimização para velocidade e SEO.</li>
                            <li>Integração com redes sociais e ferramentas online.</li>
                        </ul>
                        <div class="text-center mt-6">
                            <a
                                href="#"
                                class="px-6 py-3 text-white bg-blue-500 hover:bg-blue-700 rounded-lg font-semibold text-lg"
                            >
                                Solicite um orçamento agora!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
