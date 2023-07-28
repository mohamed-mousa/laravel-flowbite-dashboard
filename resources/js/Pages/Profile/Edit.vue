<script setup>
import {
    UpdateProfileInformationForm,
    UpdatePasswordForm,
    UpdateProfilePicture,
} from "./Partials/profile.js";
</script>

<template>
    <Head :title="$t('profile.title')" />

    <AuthLayout>
        <template #header>
            <Header :title="$t('profile.title')">
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
            class="grid grid-cols-1 px-4 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900"
        >
            <UpdateProfilePicture />
            <div class="col-span-2">
                <UpdateProfileInformationForm />
                <UpdatePasswordForm />
            </div>
        </div>
    </AuthLayout>
</template>
