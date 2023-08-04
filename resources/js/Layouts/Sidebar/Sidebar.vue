<script setup>
import SidebarLi from "./SidebarLi.vue";
import SidebarDropdown from "./SidebarDropdown.vue";
import { useCanShow } from "@/Composables/Permission.js";

const layoutsLinks = [
    {
        name: "sidebar.siteSettings",
        url: "settings",
        show: [1],
    },
];

const props = defineProps({
    openSideBar: {
        type: Boolean,
        default: true,
    },
});
</script>
<template>
    <aside
        id="sidebar"
        :class="props.openSideBar ? 'lg:flex' : 'hidden lg:flex'"
        class="sidebar"
        aria-label="sidebar"
    >
        <div class="sidebar-container">
            <div class="sidebar-links-container">
                <div class="sidebar-links">
                    <ul>
                        <li>
                            <form>
                                <div class="relative">
                                    <div class="icon">
                                        <icon name="hi-search" />
                                    </div>
                                    <Input
                                        id="mobile-search"
                                        type="text"
                                        placeholder="Search"
                                    />
                                </div>
                            </form>
                        </li>
                        <SidebarLi
                            v-if="useCanShow([1, 2])"
                            :title="$t('sidebar.dashboard')"
                            href="dashboard"
                        >
                            <icon
                                name="hi-solid-chart-pie"
                                class="sidebar-li-icon"
                            />
                        </SidebarLi>

                        <SidebarLi
                            v-if="useCanShow([1])"
                            :title="$t('sidebar.users')"
                            href="users"
                        >
                            <icon
                                name="hi-solid-users"
                                class="sidebar-li-icon"
                            />
                        </SidebarLi>

                        <SidebarDropdown
                            :title="$t('sidebar.settings')"
                            :links="layoutsLinks"
                            id="settings"
                        >
                            <icon
                                name="hi-solid-cog"
                                class="sidebar-li-dropdown-icon"
                                aria-hidden="true"
                            />
                        </SidebarDropdown>
                    </ul>
                </div>
            </div>
        </div>
    </aside>

    <div
        :class="props.openSideBar ? '' : 'hidden'"
        class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90"
        id="sidebarBackdrop"
    ></div>
</template>
