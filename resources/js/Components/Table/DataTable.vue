<script setup>
import { InformationCircleIcon } from "@heroicons/vue/24/solid";
defineProps(["length", "total", "links", "from", "to"]);
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
        <div
            class="sticky bottom-0 end-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700"
        >
            <div class="flex items-center mb-4 sm:mb-0">
                <span
                    class="text-sm font-normal text-gray-500 dark:text-gray-400"
                    >{{ $t("showing") }}
                    <span class="font-semibold text-gray-900 dark:text-white"
                        >{{ from }}-{{ to }}</span
                    >
                    {{ $t("of") }}
                    <span class="font-semibold text-gray-900 dark:text-white">{{
                        total
                    }}</span></span
                >
            </div>
            <div class="py-8 sm:rounded-lg" v-if="links.length > 3">
                <nav
                    class="flex items-center justify-center"
                    aria-label="Table navigation"
                >
                    <ul class="inline-flex items-center -space-x-px">
                        <li v-for="(link, key) in links" :key="key">
                            <Link
                                :class="
                                    link.active
                                        ? 'z-10 mx-1 rounded border  border-opacity-30 bg-blue-50 py-2 px-3 leading-tight text-blue-600 hover:bg-blue-100 hover:text-blue-700 dark:border dark:bg-gray-700 dark:text-white'
                                        : 'mx-1 rounded border  border-opacity-30 bg-white py-2 px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border dark:bg-[#071017] dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                                "
                                :href="link.url"
                                v-html="link.label"
                            />
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>
