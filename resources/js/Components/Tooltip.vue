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
    <div
        :id="id"
        role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip"
    >
        {{ title }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</template>
