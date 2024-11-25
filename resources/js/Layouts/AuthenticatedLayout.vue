<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div class="flex flex-col h-screen bg-gray-500  dark:bg-[#000] fundo">
        <div class="  rounded-md mx-5 dark:bg-[#1d1d1d] p-6 mt-5">


               <!-- Settings Dropdown -->
               <div class="mt-auto px-4 py-2 float-end">
                <Dropdown align="right" width="48" class="bg-[#1d1d1d]">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button type="button"
                                class="inline-flex items-center rounded-md border border-transparent bg-[#121212] px-3 py-2 text-sm font-medium leading-4 text-gray-200 transition duration-150 ease-in-out hover:text-gray-400 focus:outline-none dark:bg-[#121212] dark:text-gray-400 dark:hover:text-gray-300">
                                {{ $page.props.auth.user.name }}
                                <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content >
                        <DropdownLink  :href="route('profile.edit')">
                            Profile
                        </DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;"><path d="M12 22a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22zm7-7.414V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v4.586l-1.707 1.707A.996.996 0 0 0 3 17v1a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-1a.996.996 0 0 0-.293-.707L19 14.586z"></path></svg>
            </div>

        </div>


        <div class="flex bg-[#000]">


        <!-- Sidebar -->
        <div class="w-64 bg-blue-800 text-white  dark:bg-[#1d1d1d] dark:text-gray-200 mx-5 rounded-lg p-2 mt-12 h-96">
            <!-- Logo -->
            <div class="p-4">
                <Link :href="route('dashboard')">
                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-200" />
                </Link>
            </div>


            <!-- Navigation Links -->
            <div class="space-y-4">
                <NavLink :class="border-none" :href="route('dashboard')" :active="route().current('dashboard')"
                    class="block px-4 py-2 text-sm">
                    Dashboard
                </NavLink>
            </div>
            <!-- Navigation Links -->
            <div class="space-y-4">
                <NavLink :href="route('domain.create')" :active="route().current('domain.index')"
                    class="block px-4 py-2 text-sm">
                    Dominios
                </NavLink>

            </div>
            <!-- Navigation Links -->
            <div class="space-y-4">
                <NavLink :href="route('pages.create')" :active="route().current('pages.create')"
                    class="block px-4 py-2 text-sm">
                    Paginas
                </NavLink>
            </div>


        </div>

        <!-- Content Area -->
        <div class="flex-1 overflow-hidden bg-[#000]  ">
            <!-- Page Content -->
            <main class="bg-[#000]">
                <slot />
            </main>
        </div>
    </div>
    </div>
</template>
<style scoped>
.fundo::before{
    content: "";
    display: block;
    background-image: url(https://addrom.com/wp-content/uploads/2024/04/noise.webp);
    opacity: .3;
    background-repeat: repeat;
    background-size: 257px auto;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    pointer-events: none;
}
</style>
