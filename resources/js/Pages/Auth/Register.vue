<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  whatsapp: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Cadastro | Notiflow" />

    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6">

      <!-- CARD COM GLOW -->
      <div class="relative group w-full max-w-5xl">

        <!-- GLOW -->
        <div
          class="absolute -inset-6 bg-sky-500/30 blur-3xl rounded-3xl
                 opacity-30 group-hover:opacity-60 transition"
        />

        <div
          class="relative grid grid-cols-1 md:grid-cols-2
                 bg-slate-900 border border-slate-800
                 rounded-2xl overflow-hidden shadow-2xl"
        >

          <!-- LADO ESQUERDO (DESKTOP) -->
          <div class="hidden md:flex p-10 flex-col justify-center text-white">
            <span class="text-sm uppercase tracking-wide text-sky-400 mb-4">
              Comece agora
            </span>

            <h1 class="text-4xl font-extrabold leading-tight mb-4">
              Pare de perder<br />
              <span class="text-sky-400">credibilidade por falhas.</span>
            </h1>

            <p class="text-slate-300 mb-6">
              Crie sua conta e monitore domínios e sites de todos os seus clientes
              em um único painel.
            </p>

            <ul class="space-y-2 text-sm text-slate-400">
              <li>✔ Alertas automáticos</li>
              <li>✔ Monitoramento 24/7</li>
              <li>✔ Ideal para agências</li>
            </ul>
          </div>

          <!-- FORMULÁRIO -->
          <div class="p-6 sm:p-8 md:p-10 flex flex-col justify-center">
            <h2 class="text-xl sm:text-2xl font-bold text-white mb-6 text-center">
              Criar conta no Notiflow
            </h2>

            <form @submit.prevent="submit" class="space-y-5">

              <div>
                <InputLabel for="name" value="Nome" class="text-slate-300" />
                <TextInput
                  id="name"
                  type="text"
                  v-model="form.name"
                  required
                  autocomplete="name"
                  class="mt-1 block w-full rounded-xl
                         bg-slate-800 border-slate-700
                         text-white placeholder-slate-400
                         focus:border-sky-500 focus:ring-sky-500"
                />
                <InputError class="mt-1" :message="form.errors.name" />
              </div>

              <div>
                <InputLabel for="email" value="Email" class="text-slate-300" />
                <TextInput
                  id="email"
                  type="email"
                  v-model="form.email"
                  required
                  autocomplete="username"
                  class="mt-1 block w-full rounded-xl
                         bg-slate-800 border-slate-700
                         text-white placeholder-slate-400
                         focus:border-sky-500 focus:ring-sky-500"
                />
                <InputError class="mt-1" :message="form.errors.email" />
              </div>

              <div>
                <InputLabel for="whatsapp" value="WhatsApp" class="text-slate-300" />
                <TextInput
                  id="whatsapp"
                  type="text"
                  v-model="form.whatsapp"
                  required
                  v-mask="['(##) ####-####', '(##) #####-####']"
                  class="mt-1 block w-full rounded-xl
                         bg-slate-800 border-slate-700
                         text-white placeholder-slate-400
                         focus:border-sky-500 focus:ring-sky-500"
                />
                <InputError class="mt-1" :message="form.errors.whatsapp" />
              </div>

              <div>
                <InputLabel for="password" value="Senha" class="text-slate-300" />
                <TextInput
                  id="password"
                  type="password"
                  v-model="form.password"
                  required
                  autocomplete="new-password"
                  class="mt-1 block w-full rounded-xl
                         bg-slate-800 border-slate-700
                         text-white placeholder-slate-400
                         focus:border-sky-500 focus:ring-sky-500"
                />
                <InputError class="mt-1" :message="form.errors.password" />
              </div>

              <div>
                <InputLabel
                  for="password_confirmation"
                  value="Confirmar senha"
                  class="text-slate-300"
                />
                <TextInput
                  id="password_confirmation"
                  type="password"
                  v-model="form.password_confirmation"
                  required
                  autocomplete="new-password"
                  class="mt-1 block w-full rounded-xl
                         bg-slate-800 border-slate-700
                         text-white placeholder-slate-400
                         focus:border-sky-500 focus:ring-sky-500"
                />
                <InputError
                  class="mt-1"
                  :message="form.errors.password_confirmation"
                />
              </div>

              <PrimaryButton
                class="w-full rounded-xl bg-sky-500 hover:bg-sky-400
                       text-slate-900 font-semibold py-3 transition"
                :class="{ 'opacity-50': form.processing }"
                :disabled="form.processing"
              >
                Criar conta
              </PrimaryButton>
            </form>

            <p class="mt-6 text-center text-sm text-slate-400">
              Já tem uma conta?
              <Link href="/login" class="text-sky-400 hover:underline">
                Entrar
              </Link>
            </p>
          </div>

        </div>
      </div>
    </div>
  </GuestLayout>
</template>
