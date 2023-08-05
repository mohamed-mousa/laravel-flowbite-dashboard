<script setup>
import { Button } from "flowbite-vue";
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
        tabindex="-1"
        data-modal-backdrop="static"
        class="fixed top-0 start-0 end-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
        <div class="relative w-full max-w-xl max-h-full">
            <div
                class="relative bg-white rounded-lg shadow dark:bg-gray-800 text-start"
            >
                <div class="px-6 py-4 border-b rounded-t dark:border-gray-600">
                    <h3
                        class="text-base text-gray-800 lg:text-lg dark:text-white"
                    >
                        {{ title }}
                    </h3>
                </div>
                <div class="p-6 text-center">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
