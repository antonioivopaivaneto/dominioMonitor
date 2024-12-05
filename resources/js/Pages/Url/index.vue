<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";

const toast = useToast();
const showDetails = ref(false);
const show = ref(false);

defineProps({ pages: Object });

const handleSubmit = async (id) => {
    try {
        const response = await axios.get('/setEnablePageVerify', { params: { id: id } });
        console.log('aqui', response);

        toast.success('Alterado com Sucesso');
    } catch (error) {
        console.error("Erro ao buscar informações do domínio:", error);
    }
};
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
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Insira seu domínio e seja notificado sobre seu status
                            </h3>
                            <Link
                                href="/pages/create"
                                class="inline-block px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300"
                            >
                                Adicionar Página
                            </Link>
                        </div>

                        <table class="min-w-full border border-gray-300">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="px-4 py-2 text-left border-b border-gray-300">#</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300">Domínio</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300">Status</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300">Última Verificação</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300">Intervalo</th>
                                    <th class="px-4 py-2 text-left border-b border-gray-300">Verificação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="page in pages"
                                    :key="page.id"
                                    class="even:bg-gray-50 odd:bg-white"
                                >
                                    <td class="px-4 py-2 border-b border-gray-300">{{ page.id }}</td>
                                    <td class="px-4 py-2 border-b border-gray-300">{{ page.url }}</td>
                                    <td
                                        class="px-4 py-2 border-b border-gray-300 capitalize"
                                        :class="{
                                            'text-green-600': page.status === 'Active',
                                            'text-yellow-500': page.status === 'Pending',
                                            'text-red-600': page.status === 'Expired',
                                        }"
                                    >
                                        {{ page.status }}
                                    </td>
                                    <td class="px-4 py-2 border-b border-gray-300">
                                        {{ page.last_verification }}
                                    </td>
                                    <td class="px-4 py-2 border-b border-gray-300">
                                        {{ page.frequency }} Minutos
                                    </td>
                                    <td class="px-4 py-2 border-b border-gray-300">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input
                                                type="checkbox"
                                                class="sr-only peer"
                                                :checked="page.verification_enabled"
                                                @click="handleSubmit(page.id)"
                                            />
                                            <div
                                                class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-500"
                                            ></div>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
