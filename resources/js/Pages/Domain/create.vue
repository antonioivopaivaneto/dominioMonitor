<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import formDomainDetails from "@/Pages/Domain/formDomainDetails.vue";
import formDomain from "@/Pages/Domain/formDomain.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

const showDetails = ref(false);
const show = ref(false);

const isHovered = ref(false);

const animationButton = ()=>{
     isHovered.value = true;

    setTimeout(() => {
         isHovered.value = false;

    }, 1000);

}

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
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg "
                >
                    <div class="py-12">
                        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <div
                                class="overflow-hidden bg-white shadow-sm sm:rounded-lg "
                            >
                                <div
                                    class="text-gray-900 p-4 dark:text-gray-900 flex justify-between"
                                >
                                <h2 class="text-3xl font-bold">Insira seu Domínio e seja notificado sobre seu status</h2>

                                    <div class="">
                                        <Link
                                        @mouseover="isHovered = true"
                                            @mouseleave="isHovered = false"
:class="{
                                                'scale-110 translate-y-[-5px]':
                                                    isHovered,
                                            }"
                                            href="/domain"
                                            class="inline-block px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300"
                                        >
                                            Acompanhar Domínios
                                        </Link>
                                    </div>
                                </div>

                                <form-domain
                                @animationButton="animationButton()"
                                    @toggleDetails="showDetails = true"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
