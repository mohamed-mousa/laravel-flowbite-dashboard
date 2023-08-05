<script setup>
import ExportExcel from "./ExportExcel.vue";
import ExportPdf from "./ExportPdf.vue";
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
            <span class="icon-style">
                <icon class="w-7 h-7" name="hi-cloud-download" />
            </span>
        </template>
        <list-group>
            <list-group-item>
                <template #prefix>
                    <icon class="h-4 w-4" name="hi-document-download" />
                </template>
                <ExportPdf :url="props.pdf" :data="props.data" />
            </list-group-item>
            <list-group-item>
                <template #prefix>
                    <icon class="h-4 w-4" name="hi-document-download" />
                </template>
                <ExportExcel :url="props.excel" :data="props.data" />
            </list-group-item>
        </list-group>
    </dropdown>
</template>
