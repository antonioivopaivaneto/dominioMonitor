<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
    style="background-image: linear-gradient(transparent,transparent),linear-gradient(287.15deg,#fafbfc,#deebff 8.06%,#b3d4ff 35.45%,#deebff 77.6%,#fafbfc)"
        class="flex flex-col items-center  pt-6 sm:justify-center sm:pt-0  "
>

        <div class="w-full bg-white ">
            <Link href="/">
                <ApplicationLogo class="h-10 w-10 fill-current text-gray-500 p-2" />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden px-6 py-4 "
        >
            <slot />
        </div>
    </div>
</template>
