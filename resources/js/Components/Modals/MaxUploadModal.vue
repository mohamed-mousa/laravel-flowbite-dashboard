<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <span
        class="hidden"
        data-modal-target="max-upload-modal"
        data-modal-toggle="max-upload-modal"
    >
    </span>
    <div
        id="max-upload-modal"
        tabindex="-1"
        data-modal-backdrop="static"
        class="fixed top-0 start-0 end-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button
                    type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="max-upload-modal"
                >
                    <icon name="hi-x" class="w-8 h-8" />
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <icon
                        name="hi-information-circle"
                        class="mx-auto mb-4 text-red-400 w-16 h-16 dark:text-red-200"
                    />
                    <h3
                        class="mb-5 text-xl font-normal text-gray-500 dark:text-gray-400"
                    >
                        {{ title }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
</template>
