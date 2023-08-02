<script setup>
import ExportExcel from "./ExportExcel.vue";
import ExportPdf from "./ExportExcel.vue";
import { Dropdown, ListGroup, ListGroupItem } from "flowbite-vue";

const props = defineProps({
    pdf: {
        type: String,
    },
    excel: {
        type: String,
    },
    data: {
        type: [Array],
        default: false,
    },
});
</script>

<template>
    <dropdown placement="right">
        <template #trigger>
            <icon class="icon-style w-9 h-9" name="hi-solid-dots-vertical" />
        </template>
        <list-group>
            <list-group-item>
                <template #prefix>
                    <icon class="h-4 w-4" name="hi-solid-document-download" />
                </template>
                <ExportPdf :url="props.pdf" :data="props.data" />
            </list-group-item>
            <list-group-item>
                <template #prefix>
                    <icon class="h-4 w-4" name="hi-solid-document-download" />
                </template>
                <ExportExcel :url="props.excel" :data="props.data" />
            </list-group-item>
        </list-group>
    </dropdown>
</template>
