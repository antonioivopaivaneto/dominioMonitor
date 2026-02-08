<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <div class="min-h-screen bg-slate-950 text-white relative overflow-hidden">

    <!-- GLOW GLOBAL SUAVE -->
    <div
      class="pointer-events-none absolute inset-0
             bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.15),transparent_60%)]"
    />

    <!-- CONTEÚDO -->
    <main class="relative flex-1 flex items-center justify-center px-6">
      <slot />
    </main>

    <!-- FOOTER -->
    <footer class="relative border-t border-slate-800 py-6 text-center text-sm text-slate-500">
      <div class="flex flex-col sm:flex-row items-center justify-center gap-2">
        <span>
          © {{ new Date().getFullYear() }} Notiflow
        </span>

        <span class="hidden sm:inline">•</span>

        <Link
          href="#"
          class="hover:text-slate-300 transition"
        >
          Política de Privacidade
        </Link>

        <span class="hidden sm:inline">•</span>

        <Link
          href="#"
          class="hover:text-slate-300 transition"
        >
          Termos de Serviço
        </Link>
      </div>
    </footer>

  </div>
</template>
