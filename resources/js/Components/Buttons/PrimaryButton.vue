<script setup>
const props = defineProps({
    loading: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
    },
});
</script>
<template>
    <button
        :class="{ 'opacity-25': loading }"
        :disabled="loading"
        class="items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex"
    >
        <icon
            name="ri-loader-2-line"
            v-if="loading"
            class="inline w-6 h-6 me-3 text-gray-200 animate-spin dark:text-gray-600"
        />

        <slot />
        {{ title }}
    </button>
</template>
