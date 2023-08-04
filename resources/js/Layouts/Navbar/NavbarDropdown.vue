<script setup>
import { useCanShow } from "@/Composables/Permission.js";
import { initDropdowns } from "flowbite";
import { onMounted } from "vue";
import { Dropdown, ListGroup, ListGroupItem } from "flowbite-vue";
const props = defineProps({
    links: {
        type: Array,
    },
    title: {
        type: String,
        required: true,
    },
});
const active = props.links.some((el) => el.url === route().current());

onMounted(() => {
    initDropdowns();
});
</script>
<template>
    <li>
        <dropdown
            class="text-gray-900 block cursor-pointer rounded-lg hover:bg-gray-100 px-3 py-2 dark:text-gray-200 dark:hover:bg-gray-700"
            :class="{
                'bg-gray-100 dark:bg-gray-700': active,
            }"
        >
            <template #trigger>
                <span>
                    <span>{{ title }}</span>
                    <icon name="hi-chevron-down" class="w-4 ms-1 h-4" />
                </span>
            </template>
            <list-group>
                <div v-for="link in links">
                    <list-group-item v-if="useCanShow(link.show)">
                        <Link
                            v-if="link.name"
                            :href="route(link.url)"
                            :class="
                                route().current(link.url)
                                    ? 'text-blue-900 dark:text-blue-700'
                                    : ' text-gray-700 dark:text-gray-200'
                            "
                            class="text-base w-full transition duration-75 rounded-lg group hover:bg-gray-100 dark:hover:bg-gray-700"
                            >{{ $t(link.name) }}</Link
                        >
                    </list-group-item>
                </div>
            </list-group>
        </dropdown>
    </li>
</template>
