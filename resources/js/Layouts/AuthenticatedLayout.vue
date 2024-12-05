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
    <div class="flex flex-col h-screen bg-gray-100">


        <div class="rounded-md mx-5 bg-white p-2 mt-5 shadow-lg ">
            <!-- Settings Dropdown -->
            <div class="mt-auto px-4 py-2 float-end">
                <Dropdown align="right" width="48" class="bg-transparent">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button type="button"
                                class="inline-flex items-center rounded-md border border-transparent bg-transparent px-3 py-2 text-sm font-medium leading-4 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(55, 55, 55, 1);"><path d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"></path></svg>
                                <svg class="-me-0.5 ms-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <DropdownLink :href="route('profile.edit')">
                            Profile
                        </DropdownLink>
                        <DropdownLink :href="route('logout')" method="post" as="button">
                            Log Out
                        </DropdownLink>
                    </template>
                </Dropdown>
            </div>
            <div>
                <b class="text-blue-500 text-xs font-black relative -bottom-7 left-5 rounded-full font-extrabold">1</b>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(55, 55, 55, 1);"><path d="M12 22a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22zm7-7.414V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v4.586l-1.707 1.707A.996.996 0 0 0 3 17v1a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-1a.996.996 0 0 0-.293-.707L19 14.586z"></path></svg>
            </div>
        </div>



            <!-- Content Area -->
            <div class="flex-1 overflow-hidden bg-gray-100">


                <div class="flex justify-center items-center bg-gray-100 mt-10 -mb-12">
            <!-- Sidebar -->
                <!-- Logo -->
                <div class="p-4">
                    <Link :href="route('dashboard')">
                        <ApplicationLogo class="block h-9 w-auto fill-current text-gray-600" />
                    </Link>
                </div>

                <!-- Navigation Links -->
                <div class="space-y-4">
                    <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                        class="block px-4 py-2 text-sm">
                        Dashboard
                    </NavLink>
                </div>
                <div class="space-y-4">
                    <NavLink :href="route('domain.create')" :active="route().current('domain.index')"
                        class="block px-4 py-2 text-sm">
                        Dominios
                    </NavLink>
                </div>
                <div class="space-y-4">
                    <NavLink :href="route('pages.create')" :active="route().current('pages.create')"
                        class="block px-4 py-2 text-sm">
                        Paginas
                    </NavLink>
                </div>
                </div>
                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </div>
        </div>
</template>

<style scoped>
.fundo::before {
    content: "";
    display: block;
    background-image: url(https://addrom.com/wp-content/uploads/2024/04/noise.webp);
    opacity: 0.1;
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
