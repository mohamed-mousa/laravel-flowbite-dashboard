<script setup>
// get page components
import {
    UpdateProfileInformationForm,
    UpdatePasswordForm,
    UpdateProfilePicture,
} from "./Partials/profile.js";

import { AuthLayout, Header, HeaderLi } from "@/Layouts/Layout.js";
</script>

<template>
    <!-- browser title -->
    <Head :title="$t('profile.title')" />

    <!-- Auth Layout -->
    <AuthLayout>
        <!-- page header -->
        <template #header>
            <Header :title="$t('profile.title')">
                <!-- Header list -->
                <HeaderLi
                    :title="$t('sidebar.dashboard')"
                    :isHome="true"
                    :url="'dashboard'"
                />
                <HeaderLi :title="$t('sidebar.users')" :url="'user'" />
                <HeaderLi :title="$t('profile.link')" :isActive="true" />
            </Header>
        </template>
        <div
            class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900"
        >
            <UpdateProfilePicture />
            <div class="col-span-2">
                <UpdateProfileInformationForm />
                <UpdatePasswordForm />
            </div>
        </div>
    </AuthLayout>
</template>
