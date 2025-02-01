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
        class="rounded-full border-gray-300 shadow-sm focus:border-gray-400 focus:ring-gray-400 dark:border-gray-400 dark:bg-white dark:text-gray-800 dark:focus:border-blue-600 dark:focus:ring-blue-600"
        v-model="model"
        ref="input"
    />
</template>
