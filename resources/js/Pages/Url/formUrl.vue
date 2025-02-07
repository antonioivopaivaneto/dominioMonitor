<template>
    <!--<img src="../../../assets/seta.png" alt="" class="w-16 -mb-12 transform rotate-90 scale-y-[-1]">-->
    <div class="flex flex-wrap justify-between items-center">

        <h3 class="text-2xl font-semibold uppercase mb-4 sm:mb-0 sm:text-xl">
            Insira sua Url e seja notificado sobre seu status
        </h3>
        <Link
            @mouseover="isHovered = true"
            @mouseleave="isHovered = false"
            href="/pages"
            class="inline-block px-4 py-2 text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300 sm:text-sm"
            :class="{
                'scale-110 translate-y-[-5px]': isHovered,
            }"
        >
            Acompanhar Paginas
        </Link>

    </div>

    <form @submit.prevent="handleSubmit" class="mt-6">
        <div
            class="flex items-center bg-gray-100 rounded-full border border-blue-700 px-4 py-2 focus-within:ring-2 focus-within:ring-blue-500"
        >
            <input
                v-model="url"
                type="text"
                placeholder="https://google.com.br"
                class="flex-1 border-none bg-transparent appearance-none leading-tight rounded-2xl focus:border-transparent focus:ring-0 text-gray-800 placeholder-gray-400 outline-none"
            />
            <button
                type="button"
                @click="handleSubmit"
                class="group flex items-center gap-2 px-3 py-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    class="fill-white transition-transform duration-200 ease-in-out group-hover:scale-125"
                >
                    <path
                        d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"
                    ></path>
                </svg>
            </button>
        </div>
    </form>

    <formUrlDetails
        :isVisible="showDetails"
        :data="dataurl"
        @close="close()"
        @sucesso="sucesso()"
        @error="error()"
    />
</template>


<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import formUrlDetails from "@/Pages/Url/formUrlDetails.vue";
import { useToast } from "vue-toastification";

const emit = defineEmits(["animationButton"]);

const toast = useToast();

const buttonName = ref("Buscar");
const url = ref("");
const dataurl = ref("");
const showDetails = ref(false);

const sucesso = () => {
    toast.success("Cadastrado com Sucesso");
    emit("animationButton");
};
const error = () => {
    toast.error("aa não,houve algum problema ao adicionar");
};

const close = () => {
    showDetails.value = false;
};

const handleSubmit = async () => {
    buttonName.value = "Buscando ...";
    try {
        const response = await axios.get("/getStatusUrl", {
            params: { url: url.value },
        });
        dataurl.value = response.data;
        showDetails.value = true;
    } catch (error) {
        console.error("Erro ao buscar informações do domínio:", error);
    }
    buttonName.value = "Buscar";
};
</script>
