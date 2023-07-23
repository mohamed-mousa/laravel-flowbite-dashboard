<script setup>
import { useNetwork } from "@vueuse/core";
const { isOnline } = useNetwork();
</script>

<template>
    <Transition
        enter-from-class="opacity-0"
        leave-to-class="opacity-0"
        class="transition ease-in-out"
    >
        <div
            id="alert-border-2"
            v-if="!isOnline"
            class="flex fixed bottom-0 z-50 w-full justify-center text-center items-center p-4 text-gray-100 dark:text-gray-200 bg-red-500"
            role="alert"
        >
            <svg
                class="flex-shrink-0 w-4 h-4"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"
                />
            </svg>
            <div class="ms-3 text-sm font-medium text-center">
                {{ $t("network status") }}
            </div>
        </div>
    </Transition>
</template>
