<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Bem-vindo ao Sistema de Monitoramento" />

        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            <div class="bg-white shadow-lg rounded-lg p-10 w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Seção de Boas-Vindas -->
                <div class="flex flex-col justify-center">
                    <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-4">
                        Monitoramento de Páginas e Domínios
                    </h1>
                    <p class="text-gray-700 text-lg">
                        Nunca perca o controle sobre seus domínios e páginas! Receba notificações sobre:
                    </p>
                    <ul class="list-disc list-inside text-gray-700 mt-4">
                        <li>Vencimentos de domínios</li>
                        <li>Indisponibilidade de páginas</li>
                        <li>Status de conectividade</li>
                    </ul>
                    <p class="mt-4 text-gray-500">
                        Mantenha sua presença online ativa e sua equipe informada.
                    </p>
                </div>

                <!-- Seção de Login -->
                <div>
                    <form @submit.prevent="submit" class="space-y-6">
                        <div v-if="status" class="text-sm text-green-600 font-medium">
                            {{ status }}
                        </div>

                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="password" value="Senha" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                            </label>
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-blue-600 hover:underline"
                            >
                                Esqueceu sua senha?
                            </Link>
                        </div>

                        <div>
                            <PrimaryButton
                                class="w-full"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Entrar
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
