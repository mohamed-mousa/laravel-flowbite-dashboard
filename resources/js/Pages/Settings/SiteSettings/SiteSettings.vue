<script setup>
// get page components
import MaxUploadModal from "@/Components/Modals/MaxUploadModal.vue";
import { AuthLayout, Header, HeaderLi } from "@/Layouts/Layout.js";
import { InputError, TextInput, InputLabel } from "@/Components/Form/Form.js";
import { Button, Avatar } from "flowbite-vue";
import { useForm, router } from "@inertiajs/vue3";

const props = defineProps({
    setting: Object,
});

// info form
const form = useForm({
    name: props.setting.name,
    email: props.setting.email,
    address: props.setting.address,
    view: props.setting.view || true,
    phone: props.setting.phone,
});

const logo = useForm({
    file: null,
});

const cover = useForm({
    file: null,
});

// upload logo action
const uploadAvatar = (e) => {
    // check file size
    if (e.target.files[0].size > 2097152) {
        document.querySelector("[data-modal-toggle]").click();
    } else {
        logo.file = e.target.files[0];
        logo.post(route("settings.logo"));
    }
};

// upload logo action
const uploadCover = (e) => {
    // check file size
    if (e.target.files[0].size > 2097152) {
        document.querySelector("[data-modal-toggle]").click();
    } else {
        cover.file = e.target.files[0];
        cover.post(route("settings.cover"));
    }
};
</script>

<template>
    <!-- browser title -->
    <Head :title="$t('sidebar.settings')" />

    <!-- Auth Layout -->
    <AuthLayout>
        <!-- page header -->
        <template #header>
            <Header :title="$t('sidebar.settings')">
                <!-- Header list -->
                <template #breadcrumb>
                    <HeaderLi
                        :title="$t('sidebar.dashboard')"
                        :isHome="true"
                        :url="'dashboard'"
                    />

                    <HeaderLi
                        :title="$t('sidebar.settings')"
                        :isActive="true"
                    />
                </template>
            </Header>
        </template>
        <div
            class="grid grid-cols-1 px-4 pb-8 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900"
        >
            <!-- Update logo component -->
            <div class="col-span-full xl:col-auto">
                <!-- Max file Upload alert -->
                <MaxUploadModal :title="$t('file large')" />

                <!-- logo -->
                <div
                    class="p-3 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-3 dark:bg-gray-800"
                >
                    <div class="items-center flex space-s-4">
                        <!-- logo image -->
                        <Avatar size="lg" :img="setting.logo" />

                        <div>
                            <!-- component title -->
                            <h3
                                class="mb-1 text-sm lg:text-lg font-bold text-gray-900 dark:text-white"
                            >
                                {{ $t("settings.site logo") }}
                            </h3>

                            <!-- picture size text -->
                            <div
                                class="mb-4 text-sm text-gray-500 dark:text-gray-400"
                            >
                                {{ $t("max size") }}
                            </div>
                            <div class="flex items-center space-s-4">
                                <!-- upload btn -->
                                <button
                                    type="button"
                                    class="inline-flex relative items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                >
                                    <icon
                                        name="hi-cloud-upload"
                                        class="w-4 h-4 me-2 -ms-1 cursor-pointer"
                                    />
                                    {{ $t("settings.logo upload") }}

                                    <TextInput
                                        type="file"
                                        accept="image/x-png,image/jpeg, image/jpg"
                                        @change="uploadAvatar"
                                        class="inset-0 w-100 h-100 opacity-0 absolute cursor-pointer"
                                    />
                                </button>

                                <!-- logo remove btn -->
                                <button
                                    type="button"
                                    v-if="setting.logo"
                                    @click="
                                        router.delete(
                                            route('settings.logo.remove')
                                        )
                                    "
                                    class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                >
                                    {{ $t("delete") }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- cover image -->
                <div
                    class="p-3 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-3 dark:bg-gray-800"
                >
                    <div class="items-center flex space-s-4">
                        <!-- cover image -->
                        <Avatar size="lg" :img="setting.cover" />

                        <div>
                            <!-- component title -->
                            <h3
                                class="mb-1 text-sm lg:text-lg font-bold text-gray-900 dark:text-white"
                            >
                                {{ $t("settings.site cover") }}
                            </h3>

                            <!-- picture size text -->
                            <div
                                class="mb-4 text-sm text-gray-500 dark:text-gray-400"
                            >
                                {{ $t("max size") }}
                            </div>
                            <div class="flex items-center space-s-4">
                                <!-- upload btn -->
                                <button
                                    type="button"
                                    class="inline-flex relative items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                >
                                    <icon
                                        name="hi-cloud-upload"
                                        class="w-4 h-4 me-2 -ms-1 cursor-pointer"
                                    />
                                    {{ $t("settings.cover upload") }}

                                    <TextInput
                                        type="file"
                                        accept="image/x-png,image/jpeg, image/jpg"
                                        @change="uploadCover"
                                        class="inset-0 w-100 h-100 opacity-0 absolute cursor-pointer"
                                    />
                                </button>

                                <!-- cover remove btn -->
                                <button
                                    type="button"
                                    v-if="setting.cover"
                                    @click="
                                        router.delete(
                                            route('settings.cover.remove')
                                        )
                                    "
                                    class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                >
                                    {{ $t("delete") }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-2">
                <!-- Update info component -->
                <div
                    class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
                >
                    <!-- component title -->
                    <h3
                        class="mb-4 text-sm lg:text-lg font-semibold dark:text-white"
                    >
                        {{ $t("settings.general settings") }}
                    </h3>
                    <form
                        @submit.prevent="form.patch(route('settings.update'))"
                    >
                        <div class="grid grid-cols-6 gap-6">
                            <!-- name -->
                            <div class="col-span-6 sm:col-span-3">
                                <InputLabel
                                    for="name"
                                    :value="$t('settings.name')"
                                />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>

                            <!-- email -->
                            <div class="col-span-6 sm:col-span-3">
                                <InputLabel
                                    for="email"
                                    :value="$t('settings.email')"
                                />
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>

                            <!-- phone -->
                            <div class="col-span-6 sm:col-span-3">
                                <InputLabel
                                    for="phone"
                                    :value="$t('settings.phone')"
                                />
                                <TextInput
                                    id="phone"
                                    type="tel"
                                    class="mt-1 block w-full"
                                    v-model="form.phone"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.phone"
                                />
                            </div>

                            <!-- address -->
                            <div class="col-span-6 sm:col-span-3">
                                <InputLabel
                                    for="address"
                                    :value="$t('settings.address')"
                                />
                                <TextInput
                                    id="address"
                                    type="tel"
                                    class="mt-1 block w-full"
                                    v-model="form.address"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.address"
                                />
                            </div>

                            <!-- address -->
                            <div class="col-span-6 sm:col-span-3">
                                <div
                                    class="flex items-center justify-start py-4"
                                >
                                    <label
                                        class="relative mx-3 flex items-center cursor-pointer"
                                    >
                                        <input
                                            type="checkbox"
                                            id="company-news"
                                            class="sr-only"
                                            v-model="form.view"
                                        />
                                        <span
                                            class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"
                                        ></span>
                                    </label>
                                    <div class="flex">
                                        <div
                                            class="lg:text-base text-sm text-gray-600 dark:text-gray-400"
                                        >
                                            {{ $t("settings.side bar") }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- submit btn -->
                            <div class="col-span-6 sm:col-full">
                                <Button
                                    type="submit"
                                    :loading="form.processing"
                                    :class="{ 'opacity-25': !form.isDirty }"
                                    :disabled="!form.isDirty"
                                    >{{ $t("save") }}</Button
                                >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
