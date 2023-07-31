<script setup>
import { HomeIcon, ChevronRightIcon } from "@heroicons/vue/24/solid";
const props = defineProps({
    url: {
        type: String,
        default: false,
    },
    title: {
        type: String,
    },
    isActive: {
        type: Boolean,
        default: false,
    },
    isHome: {
        type: Boolean,
        default: false,
    },
});
</script>
<template>
    <li class="flex items-center" :class="isHome ? 'ms-0' : 'ms-3'">
        <Link
            v-if="isHome"
            :href="url"
            class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white"
        >
            <HomeIcon class="w-5 h-5 me-2.5" />
            {{ title }}
        </Link>

        <div v-else class="flex items-center">
            <ChevronRightIcon class="w-5 h-5 text-gray-400" />
            <Link
                v-if="!isActive"
                :href="url"
                :class="
                    isActive
                        ? ' text-gray-400  dark:text-gray-500'
                        : ' text-gray-700 hover:text-primary-600  dark:text-gray-300 dark:hover:text-white'
                "
                class="ms-1 md:ms-3"
                >{{ title }}</Link
            >
            <span
                v-else
                :href="url"
                :class="
                    isActive
                        ? ' text-gray-400  dark:text-gray-500'
                        : ' text-gray-700 hover:text-primary-600  dark:text-gray-300 dark:hover:text-white'
                "
                class="ms-1 md:ms-3"
                >{{ title }}</span
            >
        </div>
    </li>
</template>
