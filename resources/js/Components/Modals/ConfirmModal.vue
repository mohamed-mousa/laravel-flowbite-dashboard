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
        <div class="relative w-full max-w-md max-h-full">
            <div
                class="relative bg-white rounded-lg shadow dark:bg-gray-700 text-start"
            >
                <Button
                    color="alternative"
                    class="border-0"
                    :data-modal-hide="id"
                >
                    <icon name="hi-x" class="w-6 h-6" />
                    <span class="sr-only">Close modal</span>
                </Button>
                <div class="p-6 text-center">
                    <icon
                        name="hi-information-circle"
                        class="mx-auto mb-4 text-red-500 w-12 h-12 dark:text-red-500"
                    />
                    <h3
                        class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                    >
                        {{ title }}
                    </h3>
                    <slot />

                    <Button
                        :data-modal-hide="id"
                        color="alternative"
                        class="ms-3"
                    >
                        {{ $t("cancel") }}
                    </Button>
                </div>
            </div>
        </div>
    </div>
</template>
