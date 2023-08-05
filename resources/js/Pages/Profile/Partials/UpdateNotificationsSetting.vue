<script setup>
import { router } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:mb-0"
    >
        <div class="flow-root">
            <h3 class="text-sm md:text-lg font-semibold dark:text-white">
                {{ $t("profile.alerts notifications") }}
            </h3>
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                <!-- notifications -->
                <div class="flex items-center justify-between py-4">
                    <div class="flex flex-col flex-grow">
                        <div
                            class="text-sm md:text-base text-gray-600 dark:text-gray-400"
                        >
                            {{ $t("profile.notifications") }}
                        </div>
                    </div>
                    <label
                        for="company-news"
                        class="relative flex items-center cursor-pointer"
                    >
                        <input
                            type="checkbox"
                            id="company-news"
                            class="sr-only"
                            :checked="$page.props.user.notification"
                            @change="router.post(route('profile.notification'))"
                        />
                        <span
                            class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"
                        ></span>
                    </label>
                </div>

                <!-- alerts -->
                <div class="flex items-center justify-between py-4">
                    <div class="flex flex-col flex-grow">
                        <div
                            class="text-sm md:text-base text-gray-600 dark:text-gray-400"
                        >
                            {{ $t("profile.alerts") }}
                        </div>
                    </div>
                    <label
                        for="account-activity"
                        class="relative flex items-center cursor-pointer"
                    >
                        <input
                            type="checkbox"
                            id="account-activity"
                            class="sr-only"
                            :checked="$page.props.user.alert"
                            @change="router.post(route('profile.alert'))"
                        />
                        <span
                            class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"
                        ></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>
