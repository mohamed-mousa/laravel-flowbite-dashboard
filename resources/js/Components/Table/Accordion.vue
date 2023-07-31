<script setup>
import { initAccordions } from "flowbite";
import { onMounted } from "vue";

onMounted(() => {
    initAccordions();
});

const props = defineProps({
    accordion: {
        type: Number,
        default: "button",
    },
});
</script>

<template>
    <div
        :id="'accordion' + props.accordion"
        data-accordion="collapse"
        class="bg-white dark:bg-gray-800 m-4 rounded border border-gray-200 dark:border-gray-700"
    >
        <h2
            :id="'accordion' + props.accordion + '-heading-3'"
            class="relative p-3 rounded justify-between flex"
        >
            <slot></slot>
            <button
                type="button"
                class="flex items-center rounded-lg p-2 ms-4 text-gray-500 border border-gray-200 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                :data-accordion-target="`#accordion${props.accordion}-body-3`"
                aria-expanded="false"
                :aria-controls="`accordion${props.accordion}-body-3`"
            >
                <icon name="hi-chevron-down" class="w-5 h-5" />
            </button>
        </h2>
        <div
            :id="`accordion${props.accordion}-body-3`"
            class="hidden border-0"
            :aria-labelledby="`accordion${props.accordion}-heading-3`"
        >
            <div
                class="mt-5 rounded bg-gray-100 dark:bg-gray-800 rounded-t-none"
            >
                <slot name="body"></slot>
            </div>
        </div>
    </div>
</template>
