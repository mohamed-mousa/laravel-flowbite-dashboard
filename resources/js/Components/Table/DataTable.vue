<script setup>
import { InformationCircleIcon } from "@heroicons/vue/24/outline";
defineProps(["length"]);
</script>

<template>
    <div class="flex flex-col data-table">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table>
                        <thead>
                            <tr>
                                <slot name="head"></slot>
                            </tr>
                        </thead>
                        <tbody>
                            <slot name="body"></slot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <h1
            v-if="length < 1"
            class="text-xl text-center py-10 font-semibold text-gray-500 dark:text-gray-300"
        >
            <InformationCircleIcon class="w-7 h-7 mx-auto" />
            {{ $t("no data") }}
        </h1>
    </div>
</template>
