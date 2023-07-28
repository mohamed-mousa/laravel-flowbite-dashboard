<script setup>
import { ExclamationCircleIcon, XMarkIcon } from "@heroicons/vue/24/outline";
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
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button
                    type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    :data-modal-hide="id"
                >
                    <XMarkIcon class="w-6 h-6" />
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <ExclamationCircleIcon
                        class="mx-auto mb-4 text-red-400 w-12 h-12 dark:text-red-200"
                    />
                    <h3
                        class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                    >
                        {{ title }}
                    </h3>
                    <slot />

                    <button
                        :data-modal-hide="id"
                        type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                    >
                        {{ $t("cancel") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
