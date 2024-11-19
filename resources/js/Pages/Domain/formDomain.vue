<template>
    <form>
        <div class="flex items-center gap-2">
            <div class="">
                <InputLabel> Domain name</InputLabel>
                <TextInput
                    v-model="domain"
                    placeholder="domain.com.br"
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

        <form-domain-details :isVisible="showDetails" :data="dataDomain"   />

    </form>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import formDomainDetails from "@/Pages/Domain/formDomainDetails.vue";


const buttonName = ref("Buscar");
const domain = ref("");
const dataDomain = ref("");
const showDetails = ref(false);

const handleSubmit = async () => {
    buttonName.value = "Buscando ...";
    try {
        const response = await axios.get('/getDomainLook',{params:{domain:domain.value}});
        dataDomain.value = response.data;
        showDetails.value= true
    } catch (error) {
        console.error("Erro ao buscar informações do domínio:", error);
    }
    buttonName.value = "Buscar";

};
</script>
