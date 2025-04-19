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

const props = defineProps({ page: Object,verificacoes: Object, search: String });

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
            router.delete(`/verificao/${pageToRemove.value}`, {
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
                            Sim, Remover Registro
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
                                Historico  de Verificação
                            </h3>
                            <Link
                                href="/pages"
                                class="inline-block px-4 py-2 text-white bg-green-500 hover:bg-green-600 rounded-lg transition duration-300"
                            >
                                Acompanhar Página
                            </Link>

                        </div>



                        <table class="min-w-full border border-gray-300">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left border-b border-gray-300"
                                    >
                                        #
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left border-b border-gray-300"
                                    >
                                        Domínio
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left border-b border-gray-300"
                                    >
                                        Status
                                    </th>
                                    <th
                                        class="px-4 py-2 text-left border-b border-gray-300"
                                    >
                                        datalhes
                                    </th>

                                    <th
                                        class="px-4 py-2 text-left border-b border-gray-300"
                                    >
                                        Remover
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="verificacao in verificacoes"
                                    :key="verificacao.id"
                                    class="even:bg-gray-50 odd:bg-white"
                                >
                                    <td
                                        class="px-4 py-2 border-b border-gray-300"
                                    >
                                        {{ verificacao.id }}
                                    </td>
                                    <td
                                        class="px-4 py-2 border-b border-gray-300"
                                    >
                                        {{ verificacao.page.url }}
                                    </td>
                                    <td
                                        class="px-4 py-2 border-b border-gray-300"
                                    >
                                        {{ verificacao.status }}
                                    </td>
                                    <td
                                        class="px-4 py-2 border-b border-gray-300"
                                    >
                                        {{ verificacao.detalhes }}
                                    </td>



                                    <td
                                        class="px-7 py-2 border-b text-gray-800"
                                    >
                                        <a
                                            @click="modalOpen(verificacao.id)"
                                            class="text-red-600 hover:text-red-800 cursor-pointer"
                                            ><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                viewBox="0 0 24 24"
                                                style="
                                                    fill: rgba(220 38 38);
                                                    transform: ;
                                                    msfilter: ;
                                                "
                                            >
                                                <path
                                                    d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"
                                                ></path></svg
                                        ></a>
                                    </td>
                                </tr>
                                <tr v-if="verificacoes.length == 0">
                                   Não a Verificaoes para essa Pagina
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-4 flex gap-2">
                            <button
                                :disabled="!verificacoes.prev_page_url"
                                @click="fetchverificacoes(verificacoes.prev_page_url)"
                                class="px-4 py-2 bg-gray-300 rounded-full"
                                :class="{
                                    'cursor-not-allowed bg-gray-400':
                                        !verificacoes.prev_page_url,
                                }"
                            >
                                Anterior
                            </button>
                            <button
                                :disabled="!verificacoes.next_page_url"
                                @click="fetchverificacoes(verificacoes.next_page_url)"
                                class="px-4 py-2 bg-gray-300 rounded-full"
                                :class="{
                                    'cursor-not-allowed bg-gray-400':
                                        !verificacoes.next_page_url,
                                }"
                            >
                                Próximo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
