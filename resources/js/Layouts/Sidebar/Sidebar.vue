<script setup>
import SidebarLi from "./SidebarLi.vue";
import SidebarDropdown from "./SidebarDropdown.vue";
import setLang from "./setLang.vue";
import {
    UsersIcon,
    MagnifyingGlassIcon,
    ChartPieIcon,
    NewspaperIcon,
    Cog8ToothIcon,
} from "@heroicons/vue/24/solid";

const layoutsLinks = [
    { name: "Stacked", url: "profile.edit" },
    { name: "Sidebar", url: "dashboard" },
];
</script>
<template>
    <aside id="sidebar" class="sidebar" aria-label="sidebar">
        <div class="sidebar-container">
            <div class="sidebar-links-container">
                <div class="sidebar-links">
                    <ul>
                        <li>
                            <form>
                                <div class="relative">
                                    <div class="icon">
                                        <MagnifyingGlassIcon />
                                    </div>
                                    <TextInput
                                        id="mobile-search"
                                        type="text"
                                        placeholder="Search"
                                    />
                                </div>
                            </form>
                        </li>
                        <SidebarLi
                            :title="$t('sidebar.dashboard')"
                            href="dashboard"
                        >
                            <ChartPieIcon class="sidebar-li-icon" />
                        </SidebarLi>

                        <SidebarLi :title="$t('sidebar.users')" href="users">
                            <UsersIcon class="sidebar-li-icon" />
                        </SidebarLi>

                        <SidebarDropdown
                            :title="$t('layouts')"
                            :links="layoutsLinks"
                            id="layouts-dropdown"
                        >
                            <NewspaperIcon
                                class="sidebar-li-dropdown-icon"
                                aria-hidden="true"
                            />
                        </SidebarDropdown>
                    </ul>
                </div>
            </div>
            <div class="sidebar-bottom-menu" sidebar-bottom-menu>
                <Link href="#" class="settings">
                    <Cog8ToothIcon class="w-6 h-6" />
                </Link>
                <setLang />
            </div>
        </div>
    </aside>

    <div
        class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90"
        id="sidebarBackdrop"
    ></div>
</template>
