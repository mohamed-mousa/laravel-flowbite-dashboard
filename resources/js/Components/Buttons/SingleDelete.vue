<script setup>
import { router } from "@inertiajs/vue3";
import ConfirmModel from "@/Components/Modals/ConfirmModal.vue";
import { Button } from "flowbite-vue";
import Tooltip from "@/Components/Tooltip.vue";

const props = defineProps({
    id: Number,
    url: String,
    number: String,
});

const deleteAction = () => {
    router.delete(route(props.url, props.id));
};
</script>

<template>
    <span
        class="icon-style"
        :data-modal-target="'delete-single' + props.number + props.id"
        :data-modal-toggle="'delete-single' + props.number + props.id"
        :data-tooltip-target="'delete-single-tooltip' + props.number + props.id"
    >
        <icon name="hi-solid-trash" class="h-6 w-6" />
    </span>
    <Tooltip
        :id="'delete-single-tooltip' + props.number + props.id"
        :title="$t('delete')"
    />

    <ConfirmModel
        :title="$t('delete confirm')"
        :id="'delete-single' + props.number + props.id"
    >
        <Button
            @click="deleteAction()"
            :data-modal-hide="'delete-single' + props.number + props.id"
            color="red"
            >{{ $t("delete") }}</Button
        >
    </ConfirmModel>
</template>
