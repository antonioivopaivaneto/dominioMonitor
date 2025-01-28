<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Esqueci minha senha" />

            <!-- Conteúdo da página -->
            <div class="bg-white shadow-lg rounded-lg p-10 w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Seção de explicação -->
                <div class="flex flex-col justify-center">
                    <h1 class="text-3xl md:text-4xl font-bold text-blue-600 mb-4">
                        Esqueci minha senha
                    </h1>
                    <p class="text-lg text-gray-700">
                        Não se preocupe! Basta informar o seu email e enviaremos um link para redefinir sua senha.
                    </p>
                    <p class="mt-4 text-gray-500">
                        Após clicar no link, você poderá escolher uma nova senha para acessar sua conta.
                    </p>
                </div>

                <!-- Formulário de recuperação de senha -->
                <div>
                    <form @submit.prevent="submit" class="space-y-6">
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

                        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                            {{ status }}
                        </div>

                        <div class="mt-4 flex items-center justify-between">
                            <PrimaryButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                class="w-full"
                            >
                                Enviar Link de Redefinição
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
    </GuestLayout>
</template>
