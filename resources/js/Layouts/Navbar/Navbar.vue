<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Apps from "./Apps.vue";
import DarkMode from "./DarkMode.vue";
import Notifications from "./Notifications.vue";
import Profile from "./Profile.vue";
import {
    Bars4Icon,
    XMarkIcon,
    MagnifyingGlassIcon,
} from "@heroicons/vue/24/solid";
</script>

<template>
    <nav class="main-nav">
        <div class="px-3 py-3 lg:px-5 lg:ps-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <Btn
                        id="toggleSidebarMobile"
                        aria-expanded="true"
                        aria-controls="sidebar"
                        class="toggleSidebarMobile"
                    >
                        <Bars4Icon
                            id="toggleSidebarMobileHamburger"
                            class="w-6 h-6"
                        />
                        <XMarkIcon
                            id="toggleSidebarMobileClose"
                            class="hidden w-6 h-6"
                        />
                    </Btn>
                    <a href="/" class="flex me-2 md:me-24">
                        <ApplicationLogo
                            class="w-12 h-12 me-3 fill-current text-gray-500"
                        />
                        <span class="app-title">Clint name </span>
                    </a>
                    <form class="hidden lg:block lg:pl-3.5">
                        <div class="relative mt-1 lg:w-96">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                            >
                                <MagnifyingGlassIcon
                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                />
                            </div>
                            <TextInput
                                id="topbar-search"
                                type="text"
                                class="mt-1 block w-full"
                                placeholder="Search"
                            />
                        </div>
                    </form>
                </div>
                <div class="flex items-center">
                    <!-- Search mobile -->
                    <Btn
                        id="toggleSidebarMobileSearch"
                        class="toggleSidebarMobileSearch"
                    >
                        <span class="sr-only">Search</span>
                        <!-- Search icon -->
                        <MagnifyingGlassIcon class="w-6 h-6" />
                    </Btn>

                    <!-- Notifications -->
                    <Notifications />

                    <!-- Apps -->
                    <Apps />

                    <!-- DarkMode -->
                    <DarkMode />

                    <!-- Profile -->
                    <Profile />
                </div>
            </div>
        </div>
    </nav>
</template>
