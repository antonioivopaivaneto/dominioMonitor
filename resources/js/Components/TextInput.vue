<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="rounded-md border-gray-300 shadow-sm focus:border-[#121212] focus:ring-[#121212] dark:border-gray-700 dark:bg-[#121212] dark:text-gray-300 dark:focus:border-orange-600 dark:focus:ring-orange-600"
        v-model="model"
        ref="input"
    />
</template>
