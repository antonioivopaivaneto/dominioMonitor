<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import formUrlDetails from "@/Pages/Url/formUrlDetails.vue";
import formUrl from "@/Pages/Url/formUrl.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

const showDetails = ref(false);
const show = ref(false);
const isHovered = ref(false);

const animationButton = () => {
    isHovered.value = true;
    setTimeout(() => {
        isHovered.value = false;
    }, 1000);
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-500 ">
                            Gerenciamento de URLs
                        </h3>
                    </div>

                    <formUrl @animationButton="animationButton()" @toggleDetails="showDetails = true" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
