<script setup>
defineProps({
    loading: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
    },
    type: {
        type: String,
        default: "button",
    },
});
</script>
<template>
    <button
        :class="{ 'opacity-25': loading }"
        :disabled="loading"
        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
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
