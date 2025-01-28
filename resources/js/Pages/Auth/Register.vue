<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Cadastro - Web Moni" />

        <div class="max-w-7xl min-h-screen flex items-center justify-center overflow-hidden">
            <div class="bg-white shadow-lg rounded-lg p-10 w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Seção de Boas-Vindas -->
                <div class="flex flex-col justify-center">
                    <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-4">
                        Cadastro - Web Moni
                    </h1>
                    <p class="text-gray-700 text-lg">
                        Crie uma conta para monitorar seus domínios e páginas! Receba notificações sobre:
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

                <!-- Formulário de Registro -->
                <div>
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <InputLabel for="name" value="Nome" />
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
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
                                autocomplete="new-password"
                            />
                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div>
                            <InputLabel for="password_confirmation" value="Confirmar Senha" />
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password_confirmation"
                            />
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <Link
                                :href="route('login')"
                                class="text-sm text-blue-600 hover:underline"
                            >
                                Já tem uma conta? Faça login
                            </Link>

                            <PrimaryButton
                                class="w-full"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Registrar
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
