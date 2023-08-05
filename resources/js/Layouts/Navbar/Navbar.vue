<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Input } from "flowbite-vue";
import DarkMode from "./DarkMode.vue";
import Notifications from "./Notifications.vue";
import Profile from "./Profile.vue";
import SetLang from "./SetLang.vue";

defineEmits(["open"]);
</script>

<template>
    <nav class="main-nav">
        <div class="px-3 py-3 lg:px-5 lg:ps-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button
                        type="button"
                        @click="$emit('open')"
                        id="toggleSidebarMobile"
                        aria-expanded="true"
                        aria-controls="sidebar"
                        class="toggleSidebarMobile"
                    >
                        <icon
                            name="hi-view-list"
                            id="toggleSidebarMobileHamburger"
                            class="w-6 h-6"
                        />
                    </button>
                    <a href="/" class="flex ms-2 md:me-11">
                        <ApplicationLogo
                            class="w-9 h-9 md:w-12 md:h-12 me-3 fill-current text-gray-500"
                        />
                        <span class="website-title">
                            {{ $page.props.setting.name }}
                        </span>
                    </a>
                    <form class="hidden lg:block lg:ps-3.5">
                        <div class="relative mt-1 lg:w-96">
                            <div
                                class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none"
                            >
                                <icon
                                    name="hi-search"
                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                />
                            </div>
                            <Input
                                id="topbar-search"
                                type="text"
                                class="mt-1 block w-full"
                                :placeholder="$t('search')"
                            />
                        </div>
                    </form>
                </div>
                <div class="flex items-center">
                    <!-- Notifications -->
                    <Notifications />

                    <!-- DarkMode -->
                    <DarkMode />

                    <!-- Search mobile -->
                    <SetLang />

                    <!-- Profile -->
                    <Profile />
                </div>
            </div>
        </div>
    </nav>
</template>
