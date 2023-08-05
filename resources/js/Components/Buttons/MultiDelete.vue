<script setup>
import { router } from "@inertiajs/vue3";
import ConfirmModel from "@/Components/Modals/ConfirmModal.vue";
import { Button } from "flowbite-vue";
import Tooltip from "@/Components/Tooltip.vue";

const props = defineProps({
    ids: Array,
    url: String,
});

const emit = defineEmits(["deleted"]);

const deleteMultiAction = () => {
    router.post(
        route(props.url),
        { ids: props.ids },
        {
            onSuccess() {
                emit("deleted");
            },
        }
    );
};
</script>

<template>
    <button
        type="button"
        class="icon-style"
        :disabled="props.ids.length < 1"
        :class="{ 'cursor-not-allowed': props.ids.length < 1 }"
        data-modal-target="delete-multi"
        data-modal-toggle="delete-multi"
        data-tooltip-target="delete-multi-tooltip"
    >
        <icon name="hi-trash" class="h-6 w-6" />
    </button>
    <Tooltip id="delete-multi-tooltip" :title="$t('delete')" />
    <ConfirmModel :title="$t('delete confirm')" id="delete-multi">
        <Button
            @click="deleteMultiAction()"
            :disabled="props.ids.length < 1"
            :class="{ 'opacity-25': props.ids.length < 1 }"
            data-modal-hide="delete-multi"
            color="red"
            >{{ $t("delete") }}</Button
        >
    </ConfirmModel>
</template>
