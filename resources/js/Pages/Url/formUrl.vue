<template>
    <form>
        <div class="flex items-center gap-2">
            <div class="">
                <InputLabel>Endereco Url </InputLabel>
                <TextInput
                    v-model="url"
                    placeholder="https://gooogle.com.br"
                    class="bg-[#121212] w-96"
                />
                <InputError />
            </div>
            <div class="mt-4">
                <button
                    type="button"
                    @click="handleSubmit"
                    class="flex gap-2 px-4 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path></svg>
                {{buttonName}}
                </button>

            </div>


        </div>

        <formUrlDetails :isVisible="showDetails" :data="dataurl" @close="close()" @sucesso="sucesso()" @error="error()"    />

    </form>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import formUrlDetails from "@/Pages/Url/formUrlDetails.vue";
import { useToast } from "vue-toastification";

const emit = defineEmits(['animationButton']);

const toast = useToast();

const buttonName = ref("Buscar");
const url = ref("");
const dataurl = ref("");
const showDetails = ref(false);

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

const handleSubmit = async () => {
    buttonName.value = "Buscando ...";
    try {
        const response = await axios.get('/getStatusUrl',{params:{url:url.value}});
        dataurl.value = response.data;
        showDetails.value= true
    } catch (error) {
        console.error("Erro ao buscar informações do domínio:", error);
    }
    buttonName.value = "Buscar";

};
</script>
