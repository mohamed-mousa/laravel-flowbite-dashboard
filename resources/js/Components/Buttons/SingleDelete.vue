<script setup>
import { router } from "@inertiajs/vue3";

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
        <TrashIcon class="h-6 w-6" />
    </span>
    <Tooltip
        :id="'delete-single-tooltip' + props.number + props.id"
        :title="$t('delete')"
    />

    <ConfirmModel
        :title="$t('delete confirm')"
        :id="'delete-single' + props.number + props.id"
    >
        <Btn
            @click="deleteAction()"
            :title="$t('delete')"
            :data-modal-hide="'delete-single' + props.number + props.id"
            class="confirm"
        />
    </ConfirmModel>
</template>
