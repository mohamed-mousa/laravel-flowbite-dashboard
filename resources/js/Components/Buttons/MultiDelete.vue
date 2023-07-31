<script setup>
import { router } from "@inertiajs/vue3";

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
    <Btn
        v-if="props.ids.length > 0"
        class="icon-style"
        :class="{ 'cursor-not-allowed': props.ids.length < 1 }"
        data-modal-target="delete-multi"
        data-modal-toggle="delete-multi"
        data-tooltip-target="delete-multi-tooltip"
        :disabled="props.ids.length < 1"
    >
        <icon name="hi-solid-trash" class="h-6 w-6" />
    </Btn>
    <Tooltip id="delete-multi-tooltip" :title="$t('delete')" />
    <ConfirmModel :title="$t('delete confirm')" id="delete-multi">
        <Btn
            @click="deleteMultiAction()"
            :disabled="props.ids.length < 1"
            :class="{ 'opacity-25': props.ids.length < 1 }"
            :title="$t('delete')"
            data-modal-hide="delete-multi"
            class="confirm"
        />
    </ConfirmModel>
</template>
