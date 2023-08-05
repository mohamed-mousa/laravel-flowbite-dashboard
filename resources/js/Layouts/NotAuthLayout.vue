<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import NetworkStatus from "@/Components/NetworkStatus.vue";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
onMounted(() => {
    initFlowbite();
});
</script>

<template>
    <NetworkStatus />
    <FlashMessages />
    <div
        class="d-flex pt-5 bg-primary header-overlay"
        :style="`background-image: url(${$page.props.setting.cover});`"
        style="
            min-height: 100vh;
            background-size: cover;
            background-position: center center;
        "
    >
        <div
            class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900"
        >
            <div>
                <Link
                    href="/"
                    class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white"
                >
                    <ApplicationLogo
                        class="w-24 h-24 fill-current text-gray-500"
                    />
                </Link>
            </div>

            <div
                class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow dark:bg-gray-900"
            >
                <slot />
            </div>
        </div>
    </div>
</template>
