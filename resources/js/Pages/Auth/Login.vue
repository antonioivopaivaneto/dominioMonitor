<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Bem-vindo ao Web Moni" />

            <div
                class="bg-white shadow-2xl rounded-lg overflow-hidden w-full max-w-5xl grid grid-cols-1 md:grid-cols-2"
            >
                <!-- Seção de Boas-Vindas -->
                <div
                    class="bg-blue-600 p-8 flex flex-col justify-center text-white"
                >
                    <h1 class="text-4xl font-bold mb-4">Notiflow</h1>
                    <p class="text-lg">
                        Mantenha o controle total sobre seus domínios e páginas
                        com o <strong>Notiflow</strong>. Receba alertas e
                        notificações em tempo real sobre:
                    </p>
                    <ul class="list-disc list-inside mt-4 text-white">
                        <li>Vencimentos de domínios</li>
                        <li>Indisponibilidade de páginas</li>
                        <li>Status de conectividade</li>
                    </ul>
                    <p class="mt-6 text-sm">
                        Garanta que sua presença online esteja sempre ativa e
                        funcional. <br />
                        <span class="font-semibold"
                            >Sua segurança e controle são nossa
                            prioridade!</span
                        >
                    </p>
                </div>

                <!-- Seção de Login -->
                <div class="p-8 flex flex-col justify-center">
                    <h2
                        class="text-2xl font-bold text-gray-800 mb-4 text-center"
                    >
                        Acesse sua conta
                    </h2>
                    <form @submit.prevent="submit" class="space-y-6">
                        <div
                            v-if="status"
                            class="text-sm text-green-600 font-medium"
                        >
                            {{ status }}
                        </div>

                        <div>
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.email"
                            />
                        </div>

                        <div>
                            <InputLabel for="password" value="Senha" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <Checkbox
                                    name="remember"
                                    v-model:checked="form.remember"
                                />
                                <span class="ml-2 text-sm text-gray-600"
                                    >Lembrar-me</span
                                >
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
                                class="w-full bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Entrar
                            </PrimaryButton>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-600">
                            Ainda não tem uma conta?
                            <Link
                                href="/register"
                                class="text-blue-600 hover:underline"
                            >
                                Cadastre-se agora </Link
                            >.
                        </p>
                    </div>
                </div>
            </div>
    </GuestLayout>
</template>
