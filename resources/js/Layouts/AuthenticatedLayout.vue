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
                <NavLink :href="route('domain.index')" :active="route().current('domain.index')"
                    class="block px-4 py-2 text-sm">
                    Dominios
                </NavLink>
            </div>
            <!-- Navigation Links -->
            <div class="space-y-4">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
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
