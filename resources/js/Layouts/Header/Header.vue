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
            'bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800':
                white,
        }"
        class="p-4 block sm:flex items-center justify-between mt-1.5 pb-0"
    >
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <slot name="breadcrumb" />
                </nav>
                <div class="md:flex md:justify-between my-5">
                    <h1
                        class="text-base font-semibold text-gray-900 sm:text-2xl dark:text-white"
                    >
                        {{ title }}
                    </h1>
                    <slot name="title-btn" />
                </div>
            </div>
            <div
                class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700"
            >
                <slot name="filter"></slot>
                <slot name="button"></slot>
            </div>
            <slot name="badge"></slot>
        </div>
    </div>
</template>
