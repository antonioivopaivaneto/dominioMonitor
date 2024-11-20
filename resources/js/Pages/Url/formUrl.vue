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
                    class="px-4 py-2 rounded-md bg-orange-600 text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                >
                {{buttonName}}
                </button>

            </div>


        </div>

        <formUrlDetails :isVisible="showDetails" :data="dataurl"   />

    </form>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import formUrlDetails from "@/Pages/Url/formUrlDetails.vue";


const buttonName = ref("Buscar");
const url = ref("");
const dataurl = ref("");
const showDetails = ref(false);

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
