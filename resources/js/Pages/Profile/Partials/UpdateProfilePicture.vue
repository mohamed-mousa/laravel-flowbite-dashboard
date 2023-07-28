<script setup>
import { ArrowUpOnSquareStackIcon } from "@heroicons/vue/24/solid";
import MaxUploadModal from "@/Components/Modals/MaxUploadModal.vue";
import { useForm, router } from "@inertiajs/vue3";

const form = useForm({
    file: null,
});

const uploadAvatar = (e) => {
    if (e.target.files[0].size > 2097152) {
        document.querySelector("[data-modal-toggle]").click();
    } else {
        form.file = e.target.files[0];
        form.post(route("profile.avatar"));
    }
};

const avatarRemove = () => {
    router.delete(route("profile.avatar.remove"));
};
</script>

<template>
    <div class="col-span-full xl:col-auto">
        <MaxUploadModal :title="$t('file large')" />
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
        >
            <div
                class="items-center sm:flex xl:block 2xl:flex sm:space-s-4 xl:space-s-0 2xl:space-s-4"
            >
                <img
                    class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0"
                    :src="$page.props.user.avatar || '/images/avatar.jpg'"
                    alt="Jese picture"
                />
                <div>
                    <h3
                        class="mb-1 text-xl font-bold text-gray-900 dark:text-white"
                    >
                        {{ $t("profile.picture") }}
                    </h3>
                    <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                        {{ $t("profile.picture size") }}
                    </div>
                    <div class="flex items-center space-s-4">
                        <Btn
                            type="button"
                            class="inline-flex relative items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        >
                            <ArrowUpOnSquareStackIcon
                                class="w-4 h-4 me-2 -ms-1"
                            />
                            {{ $t("profile.picture upload") }}

                            <TextInput
                                type="file"
                                accept="image/x-png,image/jpeg, image/jpg"
                                @change="uploadAvatar"
                                class="inset-0 w-100 h-100 opacity-0 absolute"
                            />
                        </Btn>

                        <Btn
                            @click="avatarRemove"
                            v-if="$page.props.user.avatar"
                            :title="$t('delete')"
                            class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
