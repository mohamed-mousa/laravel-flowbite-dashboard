<script setup>
const props = defineProps({
    url: {
        type: String,
    },
    data: {
        type: [Array],
        default: false,
    },
});
</script>

<template>
    <a
        target="_blank"
        class="block ms-3 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
        :href="
            route(props.url, {
                data: props.data,
            })
        "
    >
        {{ $t("export excel") }}
    </a>
</template>
