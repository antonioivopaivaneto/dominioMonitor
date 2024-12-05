<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({ dominios: Object });
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between text-gray-800">
                            <h3 class="text-lg font-semibold mb-4">
                                Insira seu Domínio e seja notificado sobre seu status
                            </h3>
                            <Link
                                href="/domain/create"
                                class="inline-block px-4 py-2 text-white bg-green-500 hover:bg-green-600 rounded-lg transition duration-300"
                            >
                                Adicionar Domínio
                            </Link>
                        </div>

                        <table class="w-full mt-6 border-collapse bg-gray-50 shadow-sm rounded-lg">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-700 border-b">#</th>
                                    <th class="px-4 py-2 text-left text-gray-700 border-b">Domínio</th>
                                    <th class="px-4 py-2 text-left text-gray-700 border-b">Status</th>
                                    <th class="px-4 py-2 text-left text-gray-700 border-b">Expiração</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="domain in dominios"
                                    :key="domain.id"
                                    class="odd:bg-white even:bg-gray-100"
                                >
                                    <td class="px-4 py-2 border-b text-gray-800">{{ domain.id }}</td>
                                    <td class="px-4 py-2 border-b text-gray-800">{{ domain.dominio }}</td>
                                    <td
                                        class="px-4 py-2 border-b capitalize"
                                        :class="{
                                            'text-green-600': domain.status === 'Active',
                                            'text-yellow-600': domain.status === 'Pending',
                                            'text-red-600': domain.status === 'Expired',
                                        }"
                                    >
                                        {{ domain.status }}
                                    </td>
                                    <td class="px-4 py-2 border-b text-gray-800">{{ domain.expiration }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
