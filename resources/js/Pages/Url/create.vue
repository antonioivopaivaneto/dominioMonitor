<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import formUrlDetails from "@/Pages/Url/formUrlDetails.vue";
import formUrl from "@/Pages/Url/formUrl.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

const showDetails = ref(false);
const show = ref(false);
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
                    <div class="py-12">
                        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <div
                                class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-[#1d1d1d]"
                            >
                                <div class="text-gray-900 dark:text-gray-100 flex justify-between">
                                    <h3 class="text-lg font-semibold mb-4">
                                        Insira sua Url e seja notificado
                                        sobre seu status
                                    </h3>

                                    <div class="">  <Link
      href="/pages"
      class="inline-block px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300"
    >
      Acompanhar Paginas
    </Link></div>
                                </div>

                                <formUrl @toggleDetails="showDetails =true" />



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
