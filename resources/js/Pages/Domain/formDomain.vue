<template>
    <form>
        <div class="flex items-center gap-2">
            <div class="">
                <InputLabel> Domain name</InputLabel>
                <TextInput
                    placeholder="domain.com.br"
                    class="bg-[#121212] w-96"
                />
                <InputError />
            </div>
            <div class="mt-4">
                <button
                    type="submit"
                    class="px-4 py-2 rounded-md bg-orange-600 text-white hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2"
                >
                    Buscar
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
</script>
