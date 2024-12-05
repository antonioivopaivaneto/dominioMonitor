<template>
    <transition>
        <div class="" v-if="isVisible">

            <!-- Exibindo as informações do domínio -->
            <div class="bg-[#e1e1e1] p-2 rounded-md mt-10 text-gray-900 flex flex-col">
                <div class="">Pagina: {{ data.url }}</div>
                <div class="">tempo: {{ data.response_time }}</div>
                <div class="">Status: {{ data.status }}</div>
                <div class="">Detalhes: {{ data.detalhes ?? 'Sem detalhes' }}</div>
            </div>

            <div class="mt-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">
                    Configuração de Notificação
                </h4>
                <form @submit.prevent="handleSubmit">
                    <div class="flex flex-col gap-4">


                        <!-- Campo para o número de dias de antecedência -->
                        <div class="">
                            <label class="block text-sm font-medium text-gray-900">
                                Verificar no intervalo em minutos
                            </label>
                            <TextInput
                                v-model="formData.frequency"
                                type="number"
                                min="1"
                                placeholder="Ex: 30 dias"
                                class="bg-[#121212] w-96"
                            />
                        </div>

                        <!-- Campo para o e-mail -->
                        <div class="">
                            <label class="block text-sm font-medium text-gray-900">
                                E-mail para notificação
                            </label>
                            <TextInput
                                v-model="formData.email"
                                type="email"
                                placeholder="email@exemplo.com"
                                class="bg-[#121212] w-96"
                            />
                        </div>

                        <!-- Botões de ação -->
                        <div class="mt-6 flex gap-5">
                            <button
                                type="submit"
                                class="px-4 py-2 rounded-md bg-orange-600 text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                            >
                                Salvar
                            </button>
                            <button
                                type="button"
                                @click="close"
                                class="px-4 py-2 rounded-md bg-gray-600 text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                            >
                                Fechar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import { router } from '@inertiajs/vue3'

const props = defineProps(["isVisible", "data"]);


const page = usePage();
const user = computed(() => page.props.auth.user);


const formData = ref({
    email: user.value.email,
    frequency: 15,
    status:'',
    url:''
});

const close = () => {
    props.isVisible = false;
};

const handleSubmit = () => {
    formData.value.status = props.data.status;
    formData.value.url = props.data.url;

    try{
        router.post('/pages', formData.value)

    }catch(e) {

    }
};
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}


</style>
