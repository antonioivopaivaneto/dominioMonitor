<template>
    <transition>
        <div class="" v-if="isVisible">

            <!-- Exibindo as informações do domínio -->
            <div class="bg-[#d5d4d4] p-2 rounded-md mt-10 text-gray-900 flex flex-col">
                <div class="">Domain: {{ data.domainName }}</div>
                <div class="">Responsável: {{ data.responsible }}</div>
                <div class="">Vencimento: {{ data.expirationDate }}</div>
            </div>

            <div class="mt-6">
                <h4 class="text-lg font-semibold text-gray-900 mb-4">
                    Configuração de Notificação
                </h4>
                <form @submit.prevent="handleModeSubmit">
                    <div class="flex flex-col gap-4">
                        <!-- Campo para o responsável -->
                        <div class="">
                            <label class="block text-sm font-medium text-gray-900">Responsável</label>
                            <TextInput
                                v-model="data.responsible"
                                placeholder="Nome do Responsável"
                                class="bg-[#121212] w-96"
                            />
                        </div>

                        <!-- Campo para o número de dias de antecedência -->
                        <div class="">
                            <label class="block text-sm font-medium text-gray-900">
                                Avisar quantos dias de antecedência
                            </label>
                            <TextInput
                                v-model="formData.anticipationDays"
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
                        <div class="text-red-500">
                            {{ $page.props.errors[0] }}

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
import { useToast } from "vue-toastification";

const toast = useToast();
const props = defineProps({
    isVisible:Boolean,
     data:Object,
    mode:{
        type:String,
        default:'create'
    }});

const emit = defineEmits(["close", "sucesso", "error"]);
const close = () => {
    emit("close");
};
const sucesso = () => {
    emit("sucesso");
};
const error = () => {
    emit("error");
};

const page = usePage();
const user = computed(() => page.props.auth.user);


const formData = ref({
    email: user.value.email,
    anticipationDays: 15,
    domain:'',
    status:'',
    expirationDate:''
});


const handleCreate = async () => {
    formData.value.domain = props.data.domainName;
    formData.value.status = props.data.status;
    formData.value.expirationDate = props.data.expirationDate;

    try{
         await router.post('/domain', formData.value,{
             preserveState: true ,
            onSuccess: (page) => {
                sucesso();
                close();
            },
            onError: (errors) => {
                error()
            }
         });




    }catch(e) {

    }
};

const handleUpdate =async () =>{
    formData.value.domain = props.data.domainName;
    formData.value.status = props.data.status;
    formData.value.expirationDate = props.data.expirationDate;
    try{
        await router.put(`/domain/${props.data.id}`,formData.value,{
            preserveState:true,
            onSuccess:()=>{
                sucesso();
                close();
            },
            onError:()=>{
                error();
            }
        })
    }catch(e){
        console.error(e);
    }

}


const handleModeSubmit = () =>{

if(props.mode ==='update'){
    handleUpdate();
}else{
    handleCreate()
}
}
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
