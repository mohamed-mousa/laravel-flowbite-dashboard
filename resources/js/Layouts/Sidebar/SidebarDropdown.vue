<script setup>
import { ChevronDownIcon } from "@heroicons/vue/24/solid";
const props = defineProps({
    links: {
        type: Array,
    },
    id: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
});

const active = props.links.some((el) => el.url === route().current());
</script>
<template>
    <li>
        <button
            :aria-expanded="active"
            type="button"
            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
            :aria-controls="id"
            :data-collapse-toggle="id"
        >
            <slot></slot>
            <span
                class="flex-1 ms-3 text-start whitespace-nowrap"
                sidebar-toggle-item
                >{{ title }}</span
            >
            <ChevronDownIcon sidebar-toggle-item class="w-5 h-5" />
        </button>
        <ul :id="id" :class="!active ? 'hidden' : ''" class="py-2 space-y-2">
            <li v-for="link in links">
                <Link
                    v-if="link.name"
                    :href="route(link.url)"
                    :class="{
                        'bg-gray-100 dark:bg-gray-700': route().current(
                            link.url
                        ),
                    }"
                    class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-lg ps-11 group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700"
                    >{{ link.name }}</Link
                >
            </li>
        </ul>
    </li>
</template>
