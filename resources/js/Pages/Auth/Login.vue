<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
  canResetPassword: Boolean,
  status: String,
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
    <Head title="Entrar | Notiflow" />

    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6">

      <!-- CARD COM GLOW -->
      <div class="relative group w-full max-w-5xl">

        <!-- GLOW -->
        <div
          class="absolute -inset-6 bg-sky-500/30 blur-3xl rounded-3xl
                 opacity-20 md:opacity-40
                 group-hover:opacity-70 transition"
        />

        <div
          class="relative grid grid-cols-1 md:grid-cols-2
                 bg-slate-900 border border-slate-800
                 rounded-2xl overflow-hidden shadow-2xl"
        >

          <!-- LADO ESQUERDO (STORY) -->
          <div
            class="hidden md:flex p-10 flex-col justify-center text-white"
          >
            <span class="text-sm uppercase tracking-wide text-sky-400 mb-4">
              Para agências digitais
            </span>

            <h1 class="text-4xl font-extrabold leading-tight mb-4">
              Antes do cliente reclamar,<br />
              <span class="text-sky-400">o Notiflow avisa.</span>
            </h1>

            <p class="text-slate-300 mb-6">
              Monitore sites e domínios de todos os seus clientes em um só lugar
              e receba alertas automáticos.
            </p>

            <ul class="space-y-2 text-sm text-slate-400">
              <li>✔ Alertas automáticos</li>
              <li>✔ Monitoramento 24/7</li>
              <li>✔ Mais credibilidade</li>
            </ul>
          </div>

          <!-- LADO DIREITO (FORM) -->
          <div class="p-6 sm:p-8 md:p-10 flex flex-col justify-center">
            <h2
              class="text-xl sm:text-2xl font-bold text-white mb-6 text-center"
            >
              Acesse sua conta
            </h2>

            <form @submit.prevent="submit" class="space-y-5">

              <div v-if="status" class="text-sm text-green-400 text-center">
                {{ status }}
              </div>

              <div>
                <InputLabel for="email" value="Email" class="text-slate-300" />
                <TextInput
                  id="email"
                  type="email"
                  v-model="form.email"
                  required
                  autofocus
                  autocomplete="username"
                  class="mt-1 block w-full rounded-xl
                         bg-slate-800 border-slate-700
                         text-white placeholder-slate-400
                         focus:border-sky-500 focus:ring-sky-500"
                />
                <InputError class="mt-1" :message="form.errors.email" />
              </div>

              <div>
                <InputLabel for="password" value="Senha" class="text-slate-300" />
                <TextInput
                  id="password"
                  type="password"
                  v-model="form.password"
                  required
                  autocomplete="current-password"
                  class="mt-1 block w-full rounded-xl
                         bg-slate-800 border-slate-700
                         text-white placeholder-slate-400
                         focus:border-sky-500 focus:ring-sky-500"
                />
                <InputError class="mt-1" :message="form.errors.password" />
              </div>

              <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-slate-400">
                  <Checkbox name="remember" v-model:checked="form.remember" />
                  <span class="ml-2">Lembrar-me</span>
                </label>

                <Link
                  v-if="canResetPassword"
                  :href="route('password.request')"
                  class="text-sky-400 hover:underline"
                >
                  Esqueceu?
                </Link>
              </div>

              <PrimaryButton
                class="w-full rounded-xl bg-sky-500 hover:bg-sky-400
                       text-slate-900 font-semibold py-3 transition"
                :class="{ 'opacity-50': form.processing }"
                :disabled="form.processing"
              >
                Entrar
              </PrimaryButton>
            </form>

            <p class="mt-6 text-center text-sm text-slate-400">
              Ainda não tem conta?
              <Link href="/register" class="text-sky-400 hover:underline">
                Criar agora
              </Link>
            </p>
          </div>

        </div>
      </div>
    </div>
  </GuestLayout>
</template>
