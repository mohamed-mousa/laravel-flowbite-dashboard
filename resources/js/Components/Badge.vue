<script setup>
import { XMarkIcon } from "@heroicons/vue/24/solid";
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
        <Btn
            @click="$emit('hide')"
            class="inline-flex items-center p-1 ms-2 text-sm text-gray-400 bg-transparent rounded-sm hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-gray-300"
        >
            <XMarkIcon class="w-4 h-4" />
        </Btn>
    </span>
</template>
