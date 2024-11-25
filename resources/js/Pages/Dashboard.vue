<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


defineProps({ pages: Number,domains:Number,verifyWithErrors:Number });

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
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="mx-auto grid grid-cols-3 gap-2">
          <div class="bg-[#111] overflow-hidden shadow-sm sm:rounded-lg">
            <div class="md:p-6 p-2 text-gray-900">
              <h3 class="text-amber-500 md:text-2xl sm:text-lg  font-semibold">
                 Dominios
              </h3>
              <p class="md:text-xl sm:text-sm mt-1">
                <span class="mr-2 text-white  ">{{ domains }}</span>
              </p>
            </div>
          </div>

          <div class="bg-[#111] overflow-hidden shadow-sm sm:rounded-lg">
            <div class="md:p-6 p-2 text-gray-900">
              <h3 class="text-blue-500 md:text-2xl sm:text-lg  font-semibold text-nowrap">
                 Paginas
              </h3>
              <p class="md:text-xl sm:text-sm mt-1">
                <span class="mr-2 text-white ">{{pages  }}</span>
              </p>
            </div>
          </div>

          <div class="bg-[#111] overflow-hidden shadow-sm sm:rounded-lg">
            <div class="md:p-6 p-2 text-gray-900">
              <h3 class="text-green-500 md:text-2xl sm:text-lg  font-semibold">
                 Paginas com Erros
              </h3>
              <p class="md:text-xl sm:text-sm mt-1">
                <span class="mr-2 text-white ">{{ verifyWithErrors }}</span>
              </p>
            </div>
          </div>
        </div>



                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
