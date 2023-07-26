<script setup>
import { router } from "@inertiajs/vue3";

const props = defineProps({
    id: Number,
    url: String,
});

const deleteAction = () => {
    router.delete(route(props.url, props.id));
};
</script>

<template>
    <span
        class="icon-style"
        data-modal-target="delete-single"
        data-modal-toggle="delete-single"
        data-tooltip-target="delete-single-tooltip"
    >
        <TrashIcon class="h-6 w-6" />
    </span>
    <Tooltip id="delete-single-tooltip" :title="$t('delete')" />

    <ConfirmModel :title="$t('delete confirm')" id="delete-single">
        <Btn
            @click="deleteAction()"
            :title="$t('delete')"
            data-modal-hide="delete-single"
            class="confirm"
        />
    </ConfirmModel>
</template>
