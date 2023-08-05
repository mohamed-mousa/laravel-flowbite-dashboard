<script setup>
// Max file Upload alert
import MaxUploadModal from "@/Components/Modals/MaxUploadModal.vue";
import { TextInput } from "@/Components/Form/Form.js";
import { Button, Avatar } from "flowbite-vue";
import Tooltip from "@/Components/Tooltip.vue";

// inertiajs and vue
import { useForm, router } from "@inertiajs/vue3";

// file form
const form = useForm({
    file: null,
});

// upload avatar action
const uploadAvatar = (e) => {
    // check file size
    if (e.target.files[0].size > 2097152) {
        document.querySelector("[data-modal-toggle]").click();
    } else {
        form.file = e.target.files[0];
        form.post(route("profile.avatar"));
    }
};

// avatar remove
const avatarRemove = () => {
    router.delete(route("profile.avatar.remove"));
};
</script>

<template>
    <!-- Update avatar component -->
    <MaxUploadModal :title="$t('file large')" />
    <div
        class="mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 p-2 dark:bg-gray-800"
    >
        <div class="items-start flex space-s-4">
            <!-- avatar image -->
            <Avatar size="lg" :img="$page.props.user.avatar" />

            <div>
                <!-- component title -->
                <h3
                    class="mb-1 text-sm md:text-lg font-bold text-gray-900 dark:text-white"
                >
                    {{ $t("profile.picture") }}
                </h3>

                <!-- picture size text -->
                <div class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                    {{ $t("max size") }}
                </div>
                <div class="flex items-center space-s-4">
                    <!-- upload btn -->
                    <button
                        type="button"
                        class="icon-style relative"
                        data-tooltip-target="add-avatar"
                    >
                        <icon
                            name="la-cloud-upload-alt-solid"
                            class="w-8 h-8 cursor-pointer"
                        />

                        <TextInput
                            type="file"
                            accept="image/x-png,image/jpeg, image/jpg"
                            @change="uploadAvatar"
                            class="inset-0 w-100 h-100 opacity-0 absolute cursor-pointer"
                        />
                    </button>
                    <Tooltip id="add-avatar" :title="$t('picture upload')" />

                    <!-- avatar remove btn -->
                    <button
                        type="button"
                        @click="avatarRemove"
                        v-if="$page.props.user.avatar"
                        class="icon-style"
                        data-tooltip-target="remove-avatar"
                    >
                        <icon name="hi-trash" class="h-6 w-6" />
                    </button>
                    <Tooltip id="remove-avatar" :title="$t('delete')" />
                </div>
            </div>
        </div>
    </div>
</template>
