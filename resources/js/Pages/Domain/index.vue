<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import formDomainDetails from "@/Pages/Domain/formDomainDetails.vue";
import formDomain from "@/Pages/Domain/formDomain.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

const showDetails = ref(false);
const show = ref(false);

defineProps({ dominios: Object });


const domain = ref([
  { id: 1, name: "example.com", status: "Active", expiration: "2025-04-01" },
  { id: 2, name: "mywebsite.net", status: "Pending", expiration: "2024-12-15" },
  { id: 3, name: "safetyfacilities.com.br", status: "Expired", expiration: "2023-11-01" },
]);
</script>


<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-[#1d1d1d]"
                >
                    <div class="py-12">
                        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                            <div
                                class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-[#1d1d1d]"
                            >
                                <div class=" flex  justify-between text-gray-900 dark:text-gray-100">
                                    <h3 class="text-lg font-semibold mb-4">
                                        Insira seu Dominio e seja notificado
                                        sobre seu status
                                    </h3>

                                    <Link
      href="/domain/create"
      class="inline-block px-4 py-2 text-white bg-purple-600 hover:bg-purple-700 rounded-lg transition duration-300"
    >
      Adicionar Domínio
    </Link>
                                </div>


                                <table class="mt-10 min-w-full table-auto bg-[#2c2c2c] text-gray-100 dark:border-gray-700">
            <thead class="bg-gray-700 text-gray-300">
              <tr>
                <th class="px-4 py-2 text-left border-b border-gray-600">#</th>
                <th class="px-4 py-2 text-left border-b border-gray-600">Domínio</th>
                <th class="px-4 py-2 text-left border-b border-gray-600">Status</th>
                <th class="px-4 py-2 text-left border-b border-gray-600">Expiração</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="domain in dominios" :key="domain.id" class="even:bg-[#242424]">
                <td class="px-4 py-2 border-b border-gray-700">{{ domain.id }}</td>
                <td class="px-4 py-2 border-b border-gray-700">{{ domain.dominio }}</td>
                <td
                  class="px-4 py-2 border-b border-gray-700 capitalize"
                  :class="{
                    'text-green-400': domain.status === 'Active',
                    'text-yellow-400': domain.status === 'Pending',
                    'text-red-400': domain.status === 'Expired'
                  }"
                >
                  {{ domain.status }}
                </td>
                <td class="px-4 py-2 border-b border-gray-700">{{ domain.expiration }}</td>
              </tr>
            </tbody>
          </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
