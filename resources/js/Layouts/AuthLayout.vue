<script setup>
import { onMounted } from "vue";
import NavBar from "./Navbar/Navbar.vue";
import NetworkStatus from "@/Components/NetworkStatus.vue";
import Sidebar from "./Sidebar/Sidebar.vue";
import { initFlowbite } from "flowbite";
onMounted(() => {
    initFlowbite();
});
</script>

<template>
    <NetworkStatus />

    <!-- Page Content -->
    <main class="bg-gray-50 dark:bg-gray-900">
        <NavBar />
        <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
            <Sidebar />

            <div
                id="main-content"
                class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ms-64 dark:bg-gray-900"
            >
                <main>
                    <slot name="header" />
                    <slot name="filter" />
                    <slot />
                </main>
            </div>
        </div>
    </main>
</template>
