<script setup>
defineProps(["length", "total", "links"]);
</script>

<template>
    <div
        v-if="length > 0"
        class="sticky bottom-0 end-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700"
    >
        <div class="lg:flex hidden items-center mb-4 sm:mb-0">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"
                >{{ $t("showing") }}
                <span class="font-semibold text-gray-900 dark:text-white">
                    <slot></slot>
                </span>
                {{ $t("of") }}
                <span class="font-semibold text-gray-900 dark:text-white">{{
                    total
                }}</span></span
            >
        </div>
        <div class="lg:py-3 sm:rounded-lg" v-if="links.length > 3">
            <nav
                class="flex items-center justify-center"
                aria-label="Table navigation"
            >
                <ul class="inline-flex items-center space-s-3">
                    <!-- <li v-for="(link, key) in links" :key="key">
                            <Link
                                :class="
                                    link.active
                                        ? 'z-10 mx-1 rounded border  border-opacity-30 bg-blue-50 py-2 px-3 leading-tight text-blue-600 hover:bg-blue-100 hover:text-blue-700 dark:border dark:bg-gray-700 dark:text-white'
                                        : 'mx-1 rounded border  border-opacity-30 bg-white py-2 px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:border dark:bg-[#071017] dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                                "
                                :href="link.url"
                                v-html="link.label"
                            />
                        </li> -->
                    <li>
                        <Link
                            class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            :href="links[0].url"
                            v-html="links[0].label"
                        />
                    </li>
                    <li>
                        <Link
                            class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            :href="links[links.length - 1].url"
                            v-html="links[links.length - 1].label"
                        />
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
