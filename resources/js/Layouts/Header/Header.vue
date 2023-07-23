<script setup>
const props = defineProps({
    white: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
    },
    nav: {
        type: Object,
    },
});
</script>
<template>
    <div
        :class="{
            'bg-white border-b border-gray-200 dark:border-gray-700 ': white,
        }"
        class="p-4 block sm:flex items-center justify-between lg:mt-1.5 dark:bg-gray-800"
    >
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <slot />
                </nav>
                <h1
                    class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-gray-300"
                >
                    {{ title }}
                </h1>
            </div>
            <div
                class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700"
            >
                <slot name="filter"> </slot>
            </div>
        </div>
    </div>
</template>
