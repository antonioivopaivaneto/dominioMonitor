<template>
     <Head title="Dashboard" />

<AuthenticatedLayout>
    <template #header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Dashboard
        </h2>
    </template>

    <button
    @click="goBack"
    class="px-4 py-2 bg-blue-500 text-white rounded"
>
    Voltar
</button>



    <form >






        <form @submit.prevent="handleSubmit" class="mt-6">


        </form>






    </form>
</AuthenticatedLayout>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { onMounted, ref } from "vue";
import { router } from "@inertiajs/vue3";
import formDomainDetails from "@/Pages/Domain/formDomainDetails.vue";
import { useToast } from "vue-toastification";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const emit = defineEmits(['animationButton']);
const props = defineProps({ dominio: Object});


const goBack = () => {
    window.history.back();
};

const toast = useToast();
const sucesso = () =>{
    toast.success('Cadastrado com Sucesso');
    emit('animationButton');

}
const error = () =>{
    toast.error('aa não,houve algum problema ao adicionar');

}

const close = () =>{

    showDetails.value= false
}

const buttonName = ref("Buscar");
const domain = ref(props.dominio?.dominio );
const dataDomain = ref("");
const showDetails = ref(false);
const fieldError = ref("");


onMounted(()=>{
    console.log('domain',domain.value)
if(domain.value){
    handleSubmit()
}
})

const handleSubmit = async () => {
    buttonName.value = "Buscando ...";
    try {
        const response = await axios.get('/getDomainLook',{params:{domain:domain.value}});
        dataDomain.value = response.data;
        showDetails.value= true
    } catch (error) {
        console.error("Erro ao buscar informações do domínio:", error);

            fieldError.value = "Erro ao buscar informações do domínio: Verifique se voce digitou corretamente";


    }
    buttonName.value = "Buscar";

};
</script>
