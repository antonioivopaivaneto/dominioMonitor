<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';

// Define props que são passadas pelo Inertia
const props = defineProps({
  pages: Array,
  offlinePages: Array,
  bestPages: Array,
  worstPages: Array,
});
</script>

<template>
    <Head title="Dashboard" />

<AuthenticatedLayout>
    <template #header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Dashboard
        </h2>
    </template>

    <div class="report-container">
        <h1 class="text-2xl font-semibold mb-6">Relatórios de Páginas</h1>

        <!-- Páginas Fora do Ar -->
        <section v-if="props.offlinePages.length">
            <h2 class="text-xl font-medium mt-6 flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i> Páginas Fora do Ar
            </h2>
            <table class="table-auto w-full mt-4 border-collapse">
                <thead>
                    <tr class="bg-red-100">
                        <th class="px-4 py-2">Página</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Última Verificação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="page in props.offlinePages" :key="page.id" class="bg-red-50">
                        <td class="px-4 py-2">{{ page.url }}</td>
                        <td class="px-4 py-2 text-red-600">Fora do Ar</td>
                        <td class="px-4 py-2">{{ page.last_verification }}</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Melhores Páginas -->
        <section v-if="props.bestPages.length">
            <h2 class="text-xl font-medium mt-6 flex items-center">
                <i class="fas fa-trophy text-yellow-500 mr-2"></i> Melhores Páginas (Baseado no Tempo)
            </h2>
            <table class="table-auto w-full mt-4 border-collapse">
                <thead>
                    <tr class="bg-yellow-100">
                        <th class="px-4 py-2">Página</th>
                        <th class="px-4 py-2">Última Verificação</th>
                        <th class="px-4 py-2">Frequência</th>
                        <th class="px-4 py-2">Tempo desde a última verificação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="page in props.bestPages" :key="page.id" class="bg-yellow-50">
                        <td class="px-4 py-2">{{ page.url }}</td>
                        <td class="px-4 py-2">{{ page.last_verification }}</td>
                        <td class="px-4 py-2">{{ page.frequency }} dias</td>
                        <td class="px-4 py-2">{{ page.time_since_last_verification }} dias</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Piores Páginas -->
        <section v-if="props.worstPages.length">
            <h2 class="text-xl font-medium mt-6 flex items-center">
                <i class="fas fa-times-circle text-purple-500 mr-2"></i> Piores Páginas (Mais Falhas de Verificação)
            </h2>
            <table class="table-auto w-full mt-4 border-collapse">
                <thead>
                    <tr class="bg-purple-100">
                        <th class="px-4 py-2">Página</th>
                        <th class="px-4 py-2">Número de Falhas</th>
                        <th class="px-4 py-2">Última Falha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="page in props.worstPages" :key="page.id" class="bg-purple-50">
                        <td class="px-4 py-2">{{ page.url }}</td>
                        <td class="px-4 py-2">{{ page.failure_count }}</td>
                        <td class="px-4 py-2">{{ page.last_failure }}</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Páginas Regulares -->
        <section v-if="props.pages.length">
            <h2 class="text-xl font-medium mt-6 flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-2"></i> Páginas Regulares
            </h2>
            <table class="table-auto w-full mt-4 border-collapse">
                <thead>
                    <tr class="bg-green-100">
                        <th class="px-4 py-2">Página</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Última Verificação</th>
                        <th class="px-4 py-2">Frequência</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="report in props.pages" :key="report.id" class="bg-green-50">
                        <td class="px-4 py-2">{{ report.url }}</td>
                        <td class="px-4 py-2 text-green-600">{{ report.status }}</td>
                        <td class="px-4 py-2">{{ report.last_verification }}</td>
                        <td class="px-4 py-2">{{ report.frequency }} dias</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.report-container {
    padding: 20px;
}
.table-auto {
    width: 100%;
    border-collapse: collapse;
}
.table-auto th,
.table-auto td {
    border: 1px solid #ccc;
    text-align: left;
    padding: 8px;
}
.loading {
    font-size: 18px;
    color: #888;
}
.error-message {
    color: red;
    font-size: 16px;
}
</style>
