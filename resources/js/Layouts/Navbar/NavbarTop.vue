<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavbarLi from "./NavbarLi.vue";
import NavbarDropdown from "./NavbarDropdown.vue";
import { useCanShow } from "@/Composables/Permission.js";
import DarkMode from "./DarkMode.vue";
import Notifications from "./Notifications.vue";
import Profile from "./Profile.vue";
import SetLang from "./SetLang.vue";
import { ref } from "vue";
const settingsLinks = [
    {
        name: "sidebar.siteSettings",
        url: "settings",
        show: [1],
    },
];
const showMobileMenu = ref(false);
</script>

<template>
    <header>
        <nav
            class="fixed z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 py-3 px-4"
        >
            <div
                class="flex justify-between items-center max-w-screen-2xl mx-auto"
            >
                <div class="flex justify-start items-center">
                    <a href="/" class="sm:flex ms-2 md:me-11">
                        <ApplicationLogo
                            class="w-9 h-9 md:w-12 md:h-12 me-3 fill-current text-gray-500"
                        />
                        <span class="website-title">
                            {{ $page.props.setting.name }}
                        </span>
                    </a>

                    <div
                        class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1"
                    >
                        <ul
                            class="flex flex-col mt-4 space-s-4 text-sm font-medium lg:flex-row xl:space-s-6 lg:mt-0"
                        >
                            <NavbarLi
                                v-if="useCanShow([1, 2])"
                                :title="$t('sidebar.dashboard')"
                                href="dashboard"
                            />

                            <NavbarLi
                                v-if="useCanShow([1])"
                                :title="$t('sidebar.users')"
                                href="users"
                            />
                            <NavbarDropdown
                                :title="$t('sidebar.settings')"
                                :links="settingsLinks"
                            />
                        </ul>
                    </div>
                </div>
                <div class="flex justify-between items-center lg:order-2">
                    <!-- Notifications -->
                    <Notifications />

                    <!-- DarkMode -->
                    <DarkMode />

                    <!-- Search mobile -->
                    <SetLang />

                    <!-- Profile -->
                    <Profile />

                    <button
                        @click="showMobileMenu = !showMobileMenu"
                        type="button"
                        id="toggleMobileMenuButton"
                        data-collapse-toggle="toggleMobileMenu"
                        class="items-center p-2 text-gray-500 rounded-lg md:ml-2 lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    >
                        <span class="sr-only">Open menu</span>
                        <icon
                            name="hi-view-list"
                            id="toggleSidebarMobileHamburger"
                            class="w-6 h-6"
                        />
                    </button>
                </div>
            </div>
        </nav>
        <nav class="bg-white dark:bg-gray-900">
            <ul
                :class="showMobileMenu ? '' : 'hidden lg:hidden'"
                id="toggleMobileMenu"
                class="flex-col p-5 w-full text-sm min-h-screen font-medium absolute z-40 bg-white dark:bg-gray-900"
            >
                <li class="mb-5 text-end">
                    <icon
                        name="hi-x"
                        class="w-7 h-7"
                        @click="showMobileMenu = !showMobileMenu"
                    />
                </li>
                <NavbarLi
                    class="mb-3"
                    v-if="useCanShow([1, 2])"
                    :title="$t('sidebar.dashboard')"
                    href="dashboard"
                />

                <NavbarLi
                    class="mb-3"
                    v-if="useCanShow([1])"
                    :title="$t('sidebar.users')"
                    href="users"
                />
                <NavbarDropdown
                    class="mb-3"
                    :title="$t('sidebar.settings')"
                    :links="settingsLinks"
                />
            </ul>
        </nav>
    </header>
</template>
