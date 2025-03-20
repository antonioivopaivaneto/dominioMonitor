<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const isSidebarOpen = ref(false); // Controla a visibilidade do menu no mobile
</script>

<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside
      :class="[
        'w-64 bg-white shadow-lg md:static fixed md:left-0',
        isSidebarOpen ? 'left-0' : '-left-64',
        'transition-all duration-300',
        'md:block'
      ]"
      :style="{ top: '0', bottom: '0' }"
    >
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
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-3" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(100, 100, 100, 1);transform: ;msFilter:;">
            <path d="M11.488 21.754c.294.157.663.156.957-.001 8.012-4.304 8.581-12.713 8.574-15.104a.988.988 0 0 0-.596-.903l-8.05-3.566a1.005 1.005 0 0 0-.813.001L3.566 5.747a.99.99 0 0 0-.592.892c-.034 2.379.445 10.806 8.514 15.115zM8.674 10.293l2.293 2.293 4.293-4.293 1.414 1.414-5.707 5.707-3.707-3.707 1.414-1.414z"></path>
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
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-3" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(100, 100, 100, 1);transform: ;msFilter:;">
            <path d="M8.465 11.293c1.133-1.133 3.109-1.133 4.242 0l.707.707 1.414-1.414-.707-.707c-.943-.944-2.199-1.465-3.535-1.465s-2.592.521-3.535 1.465L4.929 12a5.008 5.008 0 0 0 0 7.071 4.983 4.983 0 0 0 3.535 1.462A4.982 4.982 0 0 0 12 19.071l.707-.707-1.414-1.414-.707.707a3.007 3.007 0 0 1-4.243 0 3.005 3.005 0 0 1 0-4.243l2.122-2.121z"></path><path d="m12 4.929-.707.707 1.414 1.414.707-.707a3.007 3.007 0 0 1 4.243 0 3.005 3.005 0 0 1 0 4.243l-2.122 2.121c-1.133 1.133-3.109 1.133-4.242 0L10.586 12l-1.414 1.414.707.707c.943.944 2.199 1.465 3.535 1.465s2.592-.521 3.535-1.465L19.071 12a5.008 5.008 0 0 0 0-7.071 5.006 5.006 0 0 0-7.071 0z"></path>
          </svg>
          Páginas
        </Link>
        <Link
          :href="route('report.index')"
          :class="[
            'flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100',
            route().current('report.index') ? 'bg-gray-100 text-blue-600 font-semibold' : ''
          ]"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-3" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(100, 100, 100, 1);transform: ;msFilter:;">
            <path d="m20 8-6-6H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM9 19H7v-9h2v9zm4 0h-2v-6h2v6zm4 0h-2v-3h2v3zM14 9h-1V4l5 5h-4z"></path>
          </svg>
          Relatórios
        </Link>

        <Link :href="route('logout')" method="post" as="button"
          :class="[
            'flex items-center px-4 py-3 text-gray-600 rounded-lg hover:bg-gray-100',
            route().current('report.index') ? 'bg-gray-100 text-blue-600 font-semibold' : ''
          ]"
        >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 me-3" viewBox="0 0 24 24" style="fill: rgba(100, 100, 100, 1);transform: ;msFilter:;"><path d="M18 2H6a1 1 0 0 0-1 1v9l5-4v3h6v2h-6v3l-5-4v9a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"></path></svg>
          Sair
        </Link>




      </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
      <!-- Topbar -->
      <header class="flex items-center justify-between bg-blue-600 shadow px-6 py-4 text-white">
        <button
          @click="isSidebarOpen = !isSidebarOpen"
          class="md:hidden text-white focus:outline-none"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 12h18M3 18h18" />
          </svg>
        </button>
        <h1 class="text-xl font-semibold text-white">Dashboard</h1>
        <Dropdown align="right" width="48">
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
@media (max-width: 768px) {
  /* Adiciona um estilo para exibir o menu quando estiver aberto no mobile */
  .sidebar-open {
    transform: translateX(0);
  }
}
</style>
