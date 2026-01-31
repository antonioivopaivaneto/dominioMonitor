<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import "animate.css";
import { ref } from "vue";

defineProps({
    pages: Number,
    domains: Number,
    verifyWithErrors: Number,
    lastVerify: String,
});

const propaganda = ref(true);

const closeModal = () => {
    propaganda.value = false;
};
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12 bg-gray-100">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-800">
                        <div class="mx-auto grid grid-cols-3 gap-2">
                            <div
                                class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg"
                            >
                                <div class="md:p-6 p-2 text-gray-800">
                                    <h3
                                        class="text-amber-600 md:text-2xl sm:text-lg font-semibold"
                                    >
                                        Domínios
                                    </h3>
                                    <p class="md:text-xl sm:text-sm mt-1">
                                        <span class="mr-2 text-gray-900">{{
                                            domains
                                        }}</span>
                                    </p>
                                </div>
                            </div>

                            <div
                                class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg"
                            >
                                <div class="md:p-6 p-2 text-gray-800">
                                    <h3
                                        class="text-green-600 md:text-2xl sm:text-lg font-semibold"
                                    >
                                        Páginas Sem Problemas
                                    </h3>
                                    <p class="md:text-xl sm:text-sm mt-1">
                                        <span class="mr-2 text-gray-900">{{
                                            pages
                                        }}</span>
                                    </p>
                                </div>
                            </div>

                            <div
                                class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg"
                            >


                                <div class="md:p-6 p-2 text-gray-800">
                                    <Link
          :href="route('pages.index')"

        >
                                    <h3
                                        class="text-red-600 md:text-2xl sm:text-lg font-semibold"
                                    >
                                        Páginas com Problemas
                                    </h3>
                                    <p class="md:text-xl sm:text-sm mt-1">
                                        <span class="mr-2 text-gray-900">{{
                                            verifyWithErrors
                                        }}</span>
                                    </p>
                                </Link>
                                </div>

                            </div>

                            <h1 class="animate__animated animate__flash">
                                Última Verificação em: {{ lastVerify }}
                            </h1>
                        </div>

                    </div>
                </div>

                <!-- Propaganda Modal -->
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg mt-5"
                    v-if="propaganda"
                >
                    <div
                        class="flex flex-row-reverse cursor-pointer"
                        @click="closeModal"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 0.6)"
                        >
                            <path
                                d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"
                            ></path>
                        </svg>
                    </div>

                    <!-- Tela para o plano 'free' -->
<div v-if="$page.props.auth.plan == 'free'" class="p-6 text-gray-800">
    <h2 class="text-2xl font-bold text-blue-500 mb-4">
        Monitoramento Completo para Seu Site e Domínio!
    </h2>
    <p class="text-lg text-gray-600 mb-3">
        Preocupe-se menos e mantenha seu site sempre ativo e
        funcionando perfeitamente. Receba alertas em tempo
        real sobre qualquer problema diretamente no
        WhatsApp!
    </p>
    <ul class="list-disc list-inside text-gray-600 mb-4">
        <li>Monitoramento 24/7 de sites e domínios.</li>
        <li>
            Notificações instantâneas no WhatsApp sobre
            instabilidades ou vencimentos.
        </li>
        <li>
            Verificação automática de certificados SSL e
            status do domínio.
        </li>
        <li>
            Relatórios detalhados de desempenho e uptime.
        </li>
    </ul>
    <div class="text-center mt-6">
        <a
            :href="route('checkout', { plan: 'premium' })"
            class="px-6 py-3 text-white bg-blue-500 hover:bg-blue-700 rounded-lg font-semibold text-lg"
        >
            Comece Agora!
        </a>
    </div>
</div>

<!-- Tela para o plano 'premium' -->
<div v-else class="p-6 text-gray-800">
    <h2 class="text-2xl font-bold text-blue-500 mb-4">
        Olá, {{ $page.props.auth.user.name }}! Bem-vindo ao Plano Premium!
    </h2>
    <p class="text-lg text-gray-600 mb-3">
        Aproveite todos os benefícios exclusivos do plano Premium! Com o monitoramento avançado, você tem ainda mais controle sobre o desempenho do seu site.
    </p>
    <ul class="list-disc list-inside text-gray-600 mb-4">
        <li>Monitoramento 24/7 de sites e domínios.</li>
        <li>
            Notificações instantâneas no WhatsApp sobre
            instabilidades ou vencimentos.
        </li>
        <li>
            Verificação automática de certificados SSL e
            status do domínio.
        </li>
        <li>
            Relatórios detalhados de desempenho e uptime.
        </li>
        <li>
            Acesso a funcionalidades exclusiva.
        </li>
    </ul>
    <div class="text-center mt-6">
        <Link
        :href="route('report.show')"

            class="px-6 py-3 text-white bg-green-500 hover:bg-green-700 rounded-lg font-semibold text-lg"
        >
           Acessar Relatorios Premium
        </Link>
    </div>
</div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
