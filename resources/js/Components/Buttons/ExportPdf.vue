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
    <li>
        <a
            target="_blank"
            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
            :href="
                route(props.url, {
                    data: props.data,
                })
            "
        >
            <icon class="h-5 w-5" name="bi-file-earmark-pdf-fill" />
            {{ $t("export pdf") }}
        </a>
    </li>
</template>
