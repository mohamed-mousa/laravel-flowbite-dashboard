<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: {
        type: String,
        required: true,
    },
    error: {
        type: String,
        default: "",
    },
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        :class="
            error
                ? ' border-red-300 text-red-900 focus:ring-red-700 focus:border-red-700 dark:border-red-500 dark:placeholder-red-500 placeholder-red-500 dark:text-red-500 dark:focus:ring-red-500 dark:focus:border-red-500'
                : ' border-gray-300 text-gray-900 focus:ring-primary-500 focus:border-primary-500  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500'
        "
        class="border sm:text-sm placeholder:text-sm rounded-lg block w-full p-2.5 bg-gray-50 dark:bg-gray-700"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        ref="input"
    />
</template>
