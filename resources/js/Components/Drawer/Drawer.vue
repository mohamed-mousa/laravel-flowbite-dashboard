<script setup>
const props = defineProps({
    id: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <!-- drawer component -->
    <div
        :id="id"
        class="fixed top-0 left-0 shadow-lg z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1"
        :aria-labelledby="id + '-label'"
    >
        <h5
            id="drawer-label"
            class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400"
        >
            <icon name="hi-pencil-alt" class="w-6 h-6 me-2.5" />
            {{ title }}
        </h5>
        <div class="mb-6 mt-5">
            <slot></slot>
        </div>
    </div>
</template>
