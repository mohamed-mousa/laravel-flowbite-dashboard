<script setup>
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
            <svg
                class="w-5 h-5 me-2.5"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                ></path>
            </svg>
            {{ title }}
        </Link>

        <div v-else class="flex items-center">
            <svg
                class="w-6 h-6 text-gray-400"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"
                ></path>
            </svg>
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
