<script setup>
import { TrashIcon, PlusIcon, PencilSquareIcon } from "@heroicons/vue/24/solid";
import {
    Drawer,
    DrawerButton,
    DrawerCancel,
} from "@/Components/Drawer/Drawer.js";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { useFormatDate } from "@/Composables/FormatDate.js";

defineProps({ users: Object, filters: Object });

const isEdit = ref(false);
const form = useForm({
    email: null,
    password: null,
    type: null,
    name: null,
});

const reset = () => {
    form.reset();
    form.clearErrors();
    isEdit.value = false;
};

const submit = () => {
    form.post(route("user.store"), {
        onSuccess() {
            reset();
        },
    });
};
</script>

<template>
    <Head :title="$t('users.title')" />

    <AuthLayout>
        <template #header>
            <Header :white="true" :title="$t('users.title')">
                <HeaderLi
                    :title="$t('sidebar.dashboard')"
                    :isHome="true"
                    :url="'dashboard'"
                />
                <HeaderLi :title="$t('users.title')" :isActive="true" />
                <template #filter>
                    <div class="filter-container">
                        <div class="sm:pe-3">
                            <div class="search-input-container">
                                <TextInput
                                    type="text"
                                    :placeholder="$t('users.search')"
                                />
                            </div>
                        </div>
                        <div class="filter-options">
                            <div class="filter-inputs">
                                <span class="icon-style">
                                    <TrashIcon class="h-6 w-6" />
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- drawer init and show -->
                    <DrawerButton
                        :title="$t('users.create')"
                        drawer="users-drawer"
                        @click="reset"
                    >
                        <PlusIcon class="h-5 w-5 me-1" />
                    </DrawerButton>
                    <Drawer id="users-drawer" :title="$t('users.create')">
                        <FlashMessages />
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <TextInput
                                    type="text"
                                    v-model="form.name"
                                    :error="form.errors.name"
                                    required
                                    :placeholder="$t('users.username')"
                                    autocomplete="name"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>
                            <div class="mb-4">
                                <TextInput
                                    type="email"
                                    v-model="form.email"
                                    required
                                    autocomplete="email"
                                    :placeholder="$t('users.email')"
                                    :error="form.errors.email"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>
                            <div class="mb-4">
                                <TextInput
                                    type="password"
                                    v-model="form.password"
                                    required
                                    :placeholder="$t('users.password')"
                                    :error="form.errors.password"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password"
                                />
                            </div>
                            <div class="mb-4">
                                <SelectInput
                                    v-model="form.type"
                                    :error="form.errors.type"
                                >
                                    <option disabled value="">
                                        {{ $t("users.type") }}
                                    </option>
                                    <option value="admin">
                                        {{ $t("users.admin") }}
                                    </option>
                                    <option value="user">
                                        {{ $t("users.user") }}
                                    </option>
                                </SelectInput>
                            </div>
                            <div class="flex">
                                <PrimaryButton
                                    type="submit"
                                    :loading="form.processing"
                                    :title="$t('save')"
                                />
                                <DrawerCancel
                                    @click="reset"
                                    drawer="users-drawer"
                                />
                            </div>
                        </form>
                    </Drawer>
                </template>
            </Header>
        </template>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow">
                        <table
                            class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600"
                        >
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input
                                                id="checkbox-all"
                                                aria-describedby="checkbox-1"
                                                type="checkbox"
                                                class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                                            />
                                            <label
                                                for="checkbox-all"
                                                class="sr-only"
                                                >checkbox</label
                                            >
                                        </div>
                                    </th>
                                    <th
                                        scope="col"
                                        class="p-4 text-xs font-medium text-start text-gray-500 uppercase dark:text-gray-400"
                                    >
                                        Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="p-4 text-xs font-medium text-start text-gray-500 uppercase dark:text-gray-400"
                                    >
                                        Type
                                    </th>
                                    <th
                                        scope="col"
                                        class="p-4 text-xs font-medium text-start text-gray-500 uppercase dark:text-gray-400"
                                    >
                                        created
                                    </th>
                                    <th
                                        scope="col"
                                        class="p-4 text-xs font-medium text-start text-gray-500 uppercase dark:text-gray-400"
                                    >
                                        Status
                                    </th>
                                    <th
                                        scope="col"
                                        class="p-4 text-xs font-medium text-start text-gray-500 uppercase dark:text-gray-400"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
                            >
                                <tr
                                    v-for="user in users.data"
                                    class="hover:bg-gray-100 dark:hover:bg-gray-700"
                                >
                                    <td class="w-4 p-4">
                                        <div class="flex items-center">
                                            <input
                                                id="checkbox-{{ user.id }}"
                                                aria-describedby="checkbox-1"
                                                type="checkbox"
                                                class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                                            />
                                            <label
                                                for="checkbox-{{ user.id }}"
                                                class="sr-only"
                                                >checkbox</label
                                            >
                                        </div>
                                    </td>
                                    <td
                                        class="flex items-center p-4 me-12 space-x-6 whitespace-nowrap"
                                    >
                                        <img
                                            class="w-10 h-10 rounded-full me-3"
                                            src="/images/avatar.jpg"
                                            alt="avatar"
                                        />
                                        <div
                                            class="text-sm font-normal text-gray-500 dark:text-gray-400"
                                        >
                                            <div
                                                class="text-base font-semibold text-gray-900 dark:text-white"
                                            >
                                                {{ user.name }}
                                            </div>
                                            <div
                                                class="text-sm font-normal text-gray-500 dark:text-gray-400"
                                            >
                                                {{ user.email }}
                                            </div>
                                        </div>
                                    </td>

                                    <td
                                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ user.type }}
                                    </td>
                                    <td
                                        class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ useFormatDate(user.created_at) }}
                                    </td>

                                    <td
                                        class="p-4 text-base font-normal text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        <!-- <div class="flex items-center">
                                            {{ if eq .status "Active" }}
                                            <div
                                                class="h-2.5 w-2.5 rounded-full bg-green-400 me-2"
                                            ></div>
                                            {{ else }}
                                            <div
                                                class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"
                                            ></div>
                                            {{ end }} {{ .status }}
                                        </div> -->
                                    </td>
                                    <td
                                        class="p-4 ps-0 justify-around whitespace-nowrap flex"
                                    >
                                        <PrimaryButton
                                            title="تعديل"
                                            type="button"
                                        >
                                            <PencilSquareIcon
                                                class="me-1 w-5 h-5"
                                            />
                                        </PrimaryButton>
                                        <DangerButton
                                            title="تعديل"
                                            type="button"
                                        >
                                            <TrashIcon class="me-1 w-5 h-5" />
                                        </DangerButton>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>
