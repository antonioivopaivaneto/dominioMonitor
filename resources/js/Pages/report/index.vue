<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from "vue";
import axios from "axios";
import { useToast } from "vue-toastification";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue"; // Ajuste o caminho conforme necessário

const toast = useToast();
const showDetails = ref(false);
const show = ref(false);

const props = defineProps({ pages: Object, search: String });

const search = ref(props.search || "");
const pageToRemove = ref(null);

// Controle do estado de exibição do modal
const showModal = ref(false);

// Função para lidar com o fechamento do modal
const handleClose = () => {
    showModal.value = false;
};

// Função para buscar páginas com filtro
const searchPages = () => {
    router.get(
        route("pages.index"),
        { search: search.value },
        { preserveState: true }
    );
};

const modalOpen = (id) => {
    pageToRemove.value = id;
    showModal.value = true;
};
const remover = () => {
    showModal.value = false;

    try {
        if (pageToRemove.value !== null) {
            router.delete(`/pages/${pageToRemove.value}`, {
                onSuccess: (page) => {
                    toast.success("pagina removido com sucesso");
                },
                onError: (errors) => {
                    toast.error("erro ao remover pagina");
                },
            });
        }
    } catch (error) {
        toast.error("erro ao remover pagina");
    }
};

const handleSubmit = async (id) => {
    try {
        const response = await axios.get("/setEnablePageVerify", {
            params: { id: id },
        });
        console.log("aqui", response);

        toast.success("Alterado com Sucesso");
    } catch (error) {
        console.error("Erro ao buscar informações do domínio:", error);
    }
};

const fetchPages = (url) => {
    router.get(url);
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

        <Modal
            v-model:show="showModal"
            :maxWidth="'2xl'"
            :closeable="true"
            @close="handleClose"
        >
            <template #default>
                <div class="p-6 bg-white text-black rounded-lg shadow-lg">
                    <h2 class="text-lg font-semibold">Aviso</h2>
                    <p>Voce esta prestes a remover</p>
                    <div class="flex gap-2">
                        <button
                            @click="remover()"
                            href="javascript:void(0)"
                            class="mt-4 px-4 py-2 bg-red-500 text-white rounded"
                        >
                            Sim, Remover Pagina
                        </button>
                        <button
                            @click="showModal = false"
                            class="mt-4 px-4 py-2 bg-gray-500 text-white rounded"
                        >
                            Fechar
                        </button>
                    </div>
                </div>
            </template>
        </Modal>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-semibold text-gray-800">
                                Escolha o tipo de relatório que deseja:
                            </h3>

                        </div>
                    </div>

                    <div class="grid grid-cols-3 p-2 gap-2">
                        <Link
                                href="/pages/create"
                                class="inline-block px-2 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300"
                            >
                            Relatório de Alertas e Ocorrências
                            </Link>
                        <Link
                                href="/pages/create"
                                class="inline-block px-2 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300"
                            >
                            Relatório de Disponibilidade por URL
                            </Link>
                        <Link
                                href="/pages/create"
                                class="inline-block px-2 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300"
                            >
                            Dashboard de Status Geral
                            </Link>
                        <Link
                                href="/pages/create"
                                class="inline-block px-2 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300"
                            >
                            Tempo de Resposta das URLs
                            </Link>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
