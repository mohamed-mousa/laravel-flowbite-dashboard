<script setup>
const props = defineProps({
    href: {
        type: String,
        default: "#",
    },
    title: {
        type: String,
        required: true,
    },
});
</script>
<template>
    <li>
        <Link
            :href="route(href)"
            :class="{
                'bg-gray-100 dark:bg-gray-700': route().current(href),
            }"
            class="text-gray-900 block rounded-lg hover:bg-gray-100 px-3 py-2 dark:text-gray-200 dark:hover:bg-gray-700"
        >
            <span>{{ title }}</span>
        </Link>
    </li>
</template>
