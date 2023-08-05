<script setup>
import { Avatar } from "flowbite-vue";
</script>

<template>
    <!-- Profile -->
    <button
        type="button"
        class="icon-style"
        id="profile-menu"
        aria-expanded="false"
        data-dropdown-toggle="profile-dropdown"
    >
        <Avatar size="sm" :img="$page.props.user.avatar" rounded />
    </button>
    <!-- <div>
    </div> -->
    <!-- Dropdown menu -->
    <div class="profile-dropdown" id="profile-dropdown">
        <div role="none">
            <p class="name" role="none">
                {{ $page.props.user.name }}
            </p>
            <p class="email" role="none">
                {{ $page.props.user.email }}
            </p>
        </div>
        <ul role="none">
            <li>
                <Link :href="route('profile.edit')" role="menuitem">{{
                    $t("navbar.profile")
                }}</Link>
            </li>

            <li>
                <Link
                    :href="route('logout')"
                    as="button"
                    method="post"
                    class="ps-4 py-1 dark:hover:bg-gray-600 text-start text-gray-600 dark:text-gray-300 hover:bg-gray-100 w-full"
                    role="menuitem"
                    >{{ $t("navbar.logout") }}</Link
                >
            </li>
        </ul>
    </div>
    <!-- <div class="flex items-center ms-3">
    </div> -->
</template>
