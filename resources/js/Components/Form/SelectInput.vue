<script setup>
import { ref } from "vue";

defineProps({
    modelValue: {
        type: [String, Number, Boolean],
        required: true,
    },
    error: {
        type: String,
        default: "",
    },
});

defineEmits(["update:modelValue"]);

const input = ref(null);

defineExpose({ focus: () => input.value.focus() });
</script>
<template>
    <select
        :class="
            error
                ? ' border-red-300 text-red-900 focus:ring-red-700 focus:border-red-700 dark:border-red-500 dark:placeholder-red-500 placeholder-red-500 dark:text-red-500 dark:focus:ring-red-500 dark:focus:border-red-500'
                : ' border-gray-300 text-gray-900 focus:ring-primary-500 focus:border-primary-500  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'
        "
        class="border text-sm sm:text-sm rounded-lg block w-full p-2.5 bg-gray-50 dark:bg-gray-700"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
        <slot />
    </select>
</template>
