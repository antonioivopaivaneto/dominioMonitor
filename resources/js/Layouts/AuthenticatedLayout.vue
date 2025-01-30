<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
      <div class="p-6 border-b border-gray-200">
        <Link :href="route('dashboard')">
          <ApplicationLogo class="h-12 w-auto mx-auto" />
        </Link>
      </div>
      <nav class="mt-6 space-y-2">
        <Link
          :href="route('dashboard')"
          :class="[
            'flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100',
            route().current('dashboard') ? 'bg-gray-100 text-blue-600 font-semibold' : ''
          ]"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 16h18M3 6h18" />
          </svg>
          Dashboard
        </Link>
        <Link
          :href="route('domain.index')"
          :class="[
            'flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100',
            route().current('domain.index') ? 'bg-gray-100 text-blue-600 font-semibold' : ''
          ]"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6m-8 4a9 9 0 100-18 9 9 0 000 18z" />
          </svg>
          Domínios
        </Link>
        <Link
          :href="route('pages.index')"
          :class="[
            'flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100',
            route().current('pages.index') ? 'bg-gray-100 text-blue-600 font-semibold' : ''
          ]"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8m-4-8v8m8 0h-8m8-8H4" />
          </svg>
          Páginas
        </Link>
      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Topbar -->
      <header class="flex items-center justify-between bg-blue-600 shadow px-6 py-4 text-white">
        <h1 class="text-xl font-semibold text-white">Dashboard</h1>
        <Dropdown align="right" width="48"  >
          <template #trigger>
            <button
              type="button"
              class="flex items-center px-4 py-2 text-gray-200 hover:text-gray-800 rounded-lg focus:outline-none"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 me-2" fill="currentColor" viewBox="0 0 24 24">
                <path
                  d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"
                />
                <circle cx="12" cy="12" r="4" />
              </svg>
              Perfil
            </button>
          </template>
          <template #content>
            <Link :href="route('profile.edit')" class="block text-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">Editar Perfil</Link>
            <Link :href="route('logout')" method="post" as="button" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">Sair</Link>
          </template>
        </Dropdown>
      </header>
      <div class="bg-white mx-auto w-full text-center text-blue-500">
        <p>Seu plano é: {{ $page.props.auth.plan }}</p>
      </div>

      <!-- Content -->
      <main class="flex-1 overflow-y-auto p-6">
        <slot />
      </main>
    </div>
  </div>
</template>

<style scoped>
/* No additional custom styles needed for now */
</style>
