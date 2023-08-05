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
            class="inline-flex text-sm md:text-base items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white"
        >
            <icon name="hi-home" class="w-4 h-4 md:w-4 md:h-4 me-2.5" />
            {{ title }}
        </Link>

        <div v-else class="flex items-center">
            <icon
                name="hi-chevron-right"
                class="w-4 h-4 md:w-4 md:h-4 text-gray-400"
            />
            <Link
                v-if="!isActive"
                :href="url"
                :class="
                    isActive
                        ? ' text-gray-400  dark:text-gray-500'
                        : ' text-gray-700 hover:text-primary-600  dark:text-gray-300 dark:hover:text-white'
                "
                class="ms-1 md:ms-3 text-sm md:text-base"
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
                class="ms-1 md:ms-3 text-sm md:text-base"
                >{{ title }}</span
            >
        </div>
    </li>
</template>
