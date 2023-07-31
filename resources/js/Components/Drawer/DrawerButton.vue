<script setup>
const props = defineProps({
    drawer: {
        type: String,
    },
    title: {
        type: String,
    },
});
</script>
<template>
    <button
        :data-drawer-target="drawer"
        :data-drawer-show="drawer"
        :aria-controls="drawer"
        type="button"
        class="items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 flex"
    >
        <slot />
        {{ title }}
    </button>
</template>
