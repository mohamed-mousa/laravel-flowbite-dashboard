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
            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700"
        >
            <slot></slot>
            <span class="ms-3" sidebar-toggle-item>{{ title }}</span>
        </Link>
    </li>
</template>
