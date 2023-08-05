<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

defineEmits(["hide"]);
</script>

<template>
    <span
        v-if="props.title"
        class="inline-flex items-center px-2 py-1 mx-2 mt-3 text-sm font-medium text-gray-800 bg-gray-100 rounded dark:bg-gray-700 dark:text-gray-300"
    >
        {{ props.title }}
        <button
            type="button"
            @click="$emit('hide')"
            class="inline-flex items-center p-1 ms-2 text-sm text-gray-400 bg-transparent rounded-sm hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-gray-300"
        >
            <icon name="hi-x" class="w-4 h-4" />
        </button>
    </span>
</template>
