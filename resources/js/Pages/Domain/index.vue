<script setup>
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import { useToast } from 'vue-toastification';

const toast = useToast();


const props = defineProps({ dominios: Object, search: String });
const pageToRemove = ref(null);

const showModal = ref(false);

// Função para lidar com o fechamento do modal
const handleClose = () => {
  showModal.value = false;
};

const search = ref(props.search || "");

const fetchPages = (url) => {
    router.get(url);
};

const searchPages = () => {
    router.get(
        route("domain.index"),
        { search: search.value },
        { preserveState: true }
    );
};



const modalOpen = (id)=>{
    pageToRemove.value = id;
    showModal.value =true


}
const remover = () =>{
    showModal.value = false

    try{
        if(pageToRemove.value !== null){
        router.delete(`/domain/${pageToRemove.value}`,{
            onSuccess:(page)=>{
                toast.success("pagina removido com sucesso");
            },
            onError: (errors) => {
                toast.error("erro ao remover pagina");
            }

        });
    }

    }catch(error){
        toast.error("erro ao remover pagina");

    }



}

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
        <button @click="remover()" href="javascript:void(0)" class="mt-4 px-4 py-2 bg-red-500 text-white rounded">
        Sim, Remover Pagina
      </button>
        <button @click="showModal = false" class="mt-4 px-4 py-2 bg-gray-500 text-white rounded">
        Fechar
      </button>
      </div>

    </div>
  </template>
</Modal>

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



                        <!-- Campo de Busca -->
                        <TextInput
                            v-model="search"
                            @input="searchPages"
                            placeholder="Pesquisar..."
                            class="border px-3 py-2 rounded w-full  mt-5"
                        />

                        <table class="w-full mt-6 border-collapse bg-gray-50 shadow-sm rounded-lg">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text-left text-gray-700 border-b">#</th>
                                    <th class="px-4 py-2 text-left text-gray-700 border-b">Domínio</th>
                                    <th class="px-4 py-2 text-left text-gray-700 border-b">Status</th>
                                    <th class="px-4 py-2 text-left text-gray-700 border-b">Expiração</th>
                                    <th class="px-4 py-2 text-left text-gray-700 border-b">Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="domain in dominios.data"
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
                                    <td class="px-7 py-2 border-b text-gray-800 "><a  @click="modalOpen(domain.id)"  href="javascript:void(0)" class="text-red-600 hover:text-red-800"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(220 38 38);transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z"></path></svg></a>          </td>
                                                      </tr>
                            <tr v-if="dominios.data.length == 0">Cadastre seu Dominio</tr>
                            </tbody>
                        </table>
                        <div class="mt-4 flex gap-2">
                            <button
                                :disabled="!dominios.prev_page_url"
                                @click="fetchdominios(dominios.prev_page_url)"
                                class="px-4 py-2 bg-gray-300 rounded-full"
                                :class="{'cursor-not-allowed bg-gray-400':!dominios.prev_page_url}"

                            >
                                Anterior
                            </button>
                            <button
                                :disabled="!dominios.next_page_url"
                                @click="fetchdominios(dominios.next_page_url)"
                                class="px-4 py-2 bg-gray-300 rounded-full"
                                :class="{'cursor-not-allowed bg-gray-400':!dominios.next_page_url}"
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
