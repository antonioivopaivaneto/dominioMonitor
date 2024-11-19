<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import formDomainDetails from "@/Pages/Domain/formDomainDetails.vue";
import formDomain from "@/Pages/Domain/formDomain.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const showDetails = ref(false);
const show = ref(false);
</script>

<style>
/* we will explain what these classes do next! */
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>

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
                    <div class="py-12">
                        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <div
                                class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-[#1d1d1d]"
                            >
                                <div class="text-gray-900 dark:text-gray-100">
                                    <h3 class="text-lg font-semibold mb-4">
                                        Insira seu Dominio e seja notificado
                                        sobre seu status
                                    </h3>
                                </div>

                                <form-domain />

                                <button @click="showDetails = !showDetails">
                                    Toggle
                                </button>

                                <Transition>
                                    <div class="" v-if="showDetails">
                                        <form-domain-details />
                                    </div>
                                </Transition>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
