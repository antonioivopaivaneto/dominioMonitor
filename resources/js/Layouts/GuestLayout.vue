<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col justify-between bg-gradient-to-r from-blue-500 to-blue-700 text-white">

        <!-- Conteúdo da página -->
        <div class="flex-1 flex items-center justify-center">
            <div class="w-full max-w-4xl p-6">
                <slot />
            </div>
        </div>

        <!-- Rodapé (opcional) -->
        <div class="p-4 text-sm text-center text-gray-300">
            <p>&copy; {{ new Date().getFullYear() }} Web Moni. Todos os direitos reservados.</p>
            <Link href="#" class="text-blue-300 hover:underline">
                Política de Privacidade
            </Link>
            <span class="mx-2">|</span>
            <Link href="#" class="text-blue-300 hover:underline">
                Termos de Serviço
            </Link>
        </div>

    </div>
</template>
