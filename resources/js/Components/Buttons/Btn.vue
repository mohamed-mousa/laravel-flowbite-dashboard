<template>
    <button :type="type">
        {{ title }}
        <slot />
    </button>
</template>

<script setup>
const props = defineProps({
    type: {
        type: String,
        default: "button",
    },
    title: {
        type: String,
    },
});
</script>
