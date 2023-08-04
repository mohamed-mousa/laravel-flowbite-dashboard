<script setup>
// get page components
import * as Profile from "./Partials/profile.js";

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
                <template #breadcrumb>
                    <HeaderLi
                        :title="$t('sidebar.dashboard')"
                        :isHome="true"
                        :url="'dashboard'"
                    />
                    <HeaderLi :title="$t('sidebar.users')" :url="'user'" />
                    <HeaderLi :title="$t('profile.link')" :isActive="true" />
                </template>
            </Header>
        </template>
        <div
            class="grid grid-cols-1 px-4 pb-8 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900"
        >
            <div class="col-span-full xl:col-auto">
                <Profile.UpdateProfilePicture />
                <Profile.UpdateNotificationsSetting />
            </div>
            <div class="col-span-2">
                <Profile.UpdateProfileInformationForm />
                <Profile.UpdatePasswordForm />
            </div>
        </div>
    </AuthLayout>
</template>
