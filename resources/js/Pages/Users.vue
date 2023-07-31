<script setup>
// hero icons
import { PencilSquareIcon } from "@heroicons/vue/24/solid";
import {
    Drawer,
    DrawerButton,
    DrawerCancel,
    useHideDrawer,
} from "@/Components/Drawer/Drawer.js";

import Paginate from "@/Components/Table/Paginate.vue";

// multi and single delete components
import MultiDelete from "@/Components/Buttons/MultiDelete.vue";
import SingleDelete from "@/Components/Buttons/SingleDelete.vue";

// Format date & Multi select & filter data and composables
import { useFormatDate } from "@/Composables/FormatDate.js";
import { useMultiSelect } from "@/Composables/MultiSelect.js";
import { useFilter } from "@/Composables/Filter.js";

// inertiajs and vue
import { useForm } from "@inertiajs/vue3";
import { ref, reactive, onMounted } from "vue";

// get users and filters from backend
const props = defineProps({
    users: Object,
    filters: Object,
});

// data filter
const filter = reactive({
    keyword: props.filters.keyword,
    p: props.filters.p,
});
useFilter(filter, "users");

// user form data
const form = useForm({
    email: null,
    password: null,
    type: 2,
    active: 1,
    name: null,
    id: null,
});

// edit action toggler
const isEdit = ref(false);

// use multi select composables
const { selected, selectAll } = useMultiSelect(props.users.data);

// reset form data & errors & multi select & is edit
const reset = () => {
    form.reset();
    form.clearErrors();
    selected.value = [];
    isEdit.value = false;
};

// fill from with data on edit
const editAction = (user) => {
    isEdit.value = true;
    form.email = user.email;
    form.type = user.type;
    form.active = user.active;
    form.id = user.id;
    form.name = user.name;
};

const submit = () => {
    // update user data
    if (isEdit.value) {
        form.put(route("user.update", form.id), {
            onSuccess() {
                reset();
                useHideDrawer();
            },
        });
    }

    //  save new user
    else {
        form.post(route("user.store"), {
            onSuccess() {
                reset();
            },
        });
    }
};

// set pagination to 20 on page mounted
onMounted(() => {
    if (props.filters.p) {
        filter.p = props.filters.p.replace(/\D/g, "");
    } else {
        filter.p = 20;
    }
});
</script>

<template>
    <!-- browser title -->
    <Head :title="$t('users.title')" />

    <!-- Auth layout -->
    <AuthLayout>
        <!-- page header -->
        <template #header>
            <Header :white="true" :title="$t('users.title')">
                <!-- Header list -->
                <HeaderLi
                    :title="$t('sidebar.dashboard')"
                    :isHome="true"
                    :url="'dashboard'"
                />
                <HeaderLi :title="$t('users.title')" :isActive="true" />

                <!-- Header filter -->
                <template #filter>
                    <!-- search input in Multi delete btn -->
                    <div class="filter-container">
                        <div class="sm:pe-3">
                            <div class="search-input-container">
                                <TextInput
                                    v-model="filter.keyword"
                                    type="text"
                                    :placeholder="$t('users.search')"
                                />
                            </div>
                        </div>
                        <div class="filter-options">
                            <div class="filter-inputs">
                                <MultiDelete
                                    url="users.destroy"
                                    :ids="selected"
                                    @deleted="reset()"
                                />
                                <button
                                    id="dropdownMenuIconButton"
                                    data-dropdown-toggle="dropdownDots"
                                    class="icon-style"
                                    type="button"
                                >
                                    <icon
                                        class="w-7 h-7"
                                        name="hi-solid-dots-vertical"
                                    />
                                </button>

                                <!-- Dropdown menu -->
                                <div
                                    id="dropdownDots"
                                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                                >
                                    <ul
                                        class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownMenuIconButton"
                                    >
                                        <ExportExcel
                                            url="users.export"
                                            :data="selected"
                                        />
                                        <ExportPdf
                                            url="users.pdf"
                                            :data="selected"
                                        />
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- create user Drawer btn -->
                    <DrawerButton
                        :title="$t('users.create')"
                        drawer="users-drawer"
                        @click="reset"
                    >
                        <icon name="hi-plus" class="h-5 w-5 me-1" />
                    </DrawerButton>

                    <!-- create user Drawer -->
                    <Drawer id="users-drawer" :title="$t('users.create')">
                        <form @submit.prevent="submit">
                            <!-- name -->
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

                            <!-- email -->
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

                            <!-- password -->
                            <div class="mb-4">
                                <TextInput
                                    type="password"
                                    v-model="form.password"
                                    :placeholder="$t('users.password')"
                                    :error="form.errors.password"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password"
                                />
                            </div>

                            <!-- type -->
                            <div class="mb-4">
                                <SelectInput
                                    v-model.number="form.type"
                                    :error="form.errors.type"
                                >
                                    <option disabled value="">
                                        {{ $t("users.type") }}
                                    </option>
                                    <option value="1">
                                        {{ $t("users.admin") }}
                                    </option>
                                    <option value="2">
                                        {{ $t("users.user") }}
                                    </option>
                                </SelectInput>
                            </div>

                            <!-- submit btn -->
                            <div class="flex">
                                <PrimaryButton
                                    type="submit"
                                    :loading="form.processing"
                                    :title="$t('save')"
                                />
                                <DrawerCancel
                                    @click="reset()"
                                    drawer="users-drawer"
                                />
                            </div>
                        </form>
                    </Drawer>
                </template>

                <template #badge>
                    <Badge
                        @hide="filter.keyword = null"
                        :title="filter.keyword"
                    />
                </template>
            </Header>
        </template>

        <!-- page table -->
        <DataTable
            class="lg:flex hidden"
            :length="props.users.data.length"
            :total="props.users.total"
            :links="props.users.links"
        >
            <!-- table head -->
            <template #head>
                <th>
                    <Checkbox
                        v-model:checked="selectAll"
                        class="w-4 h-4"
                        name="selectAll"
                    />
                </th>
                <th>{{ $t("users.username") }}</th>
                <th>{{ $t("users.type") }}</th>
                <th>{{ $t("users.created") }}</th>
                <th>{{ $t("users.active") }}</th>
                <th>{{ $t("actions") }}</th>
            </template>

            <!-- table body -->
            <template #body>
                <tr v-for="user in props.users.data">
                    <!-- Checkbox -->
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <Checkbox
                                :value="user.id"
                                class="w-4 h-4"
                                name="select"
                                v-model:checked="selected"
                            />
                        </div>
                    </td>

                    <!-- name & email & image -->
                    <td class="flex">
                        <img
                            class="w-10 h-10 rounded-full me-3"
                            :src="user.avatar || '/images/avatar.jpg'"
                            alt="avatar"
                        />
                        <div
                            class="text-sm font-normal text-gray-500 dark:text-gray-400"
                        >
                            <div
                                class="text-base font-semibold text-gray-900 dark:text-gray-400"
                            >
                                {{ user.name }}
                            </div>
                            <a
                                :href="`mailto:${user.email}`"
                                target="_blank"
                                class="text-sm font-normal block text-gray-500 dark:text-gray-400"
                            >
                                {{ user.email }}
                            </a>
                            <a
                                :href="`tel:${user.phone}`"
                                target="_blank"
                                class="text-sm font-normal block text-gray-500 dark:text-gray-400"
                            >
                                {{ user.phone }}
                            </a>
                        </div>
                    </td>

                    <!-- type -->
                    <td>
                        <span v-if="user.type == 1">{{
                            $t("users.admin")
                        }}</span>
                        <span v-if="user.type == 2">{{
                            $t("users.user")
                        }}</span>
                    </td>

                    <!-- created_at -->
                    <td>
                        {{ useFormatDate(user.created_at) }}
                    </td>

                    <!-- active -->
                    <td>
                        <div class="flex items-center">
                            <label
                                :for="'item-update-' + user.id"
                                class="relative flex items-center cursor-pointer switch"
                            >
                                <input
                                    @change="
                                        form.post(route('user.active', user.id))
                                    "
                                    type="checkbox"
                                    :id="'item-update-' + user.id"
                                    class="sr-only"
                                    :checked="user.active"
                                />
                                <span
                                    class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"
                                ></span>
                            </label>
                        </div>
                    </td>

                    <!-- options -->
                    <td>
                        <span
                            data-drawer-target="users-drawer"
                            data-drawer-show="users-drawer"
                            aria-controls="users-drawer"
                            data-tooltip-target="edit-tooltip"
                            class="icon-style me-3"
                            @click="editAction(user)"
                        >
                            <PencilSquareIcon class="h-6 w-6" />
                        </span>
                        <Tooltip id="edit-tooltip" :title="$t('edit')" />
                        <SingleDelete
                            url="user.destroy"
                            number="lg"
                            :id="user.id"
                        />
                    </td>
                </tr>
            </template>
            <template #paginate>
                <input
                    class="paginate-input"
                    type="text"
                    v-model.number="filter.p"
                    min="1"
                    required
                />
            </template>
        </DataTable>
        <div class="lg:hidden block">
            <div class="flex items-start px-4 pt-4">
                <Checkbox
                    v-model:checked="selectAll"
                    class="w-5 h-5"
                    name="selectAll"
                />
                <label
                    for="remember"
                    class="ms-3 text-base font-medium text-gray-900 dark:text-white"
                >
                    {{ $t("select all") }}</label
                >
            </div>

            <Accordion :accordion="user.id" v-for="user in props.users.data">
                <div class="flex items-center justify-start">
                    <Checkbox
                        :value="user.id"
                        class="w-4 h-4 me-4"
                        name="select"
                        v-model:checked="selected"
                    />
                    <img
                        class="w-10 h-10 rounded-full me-3"
                        :src="user.avatar || '/images/avatar.jpg'"
                        alt="avatar"
                    />
                    <div
                        class="text-sm font-normal text-gray-500 dark:text-gray-400"
                    >
                        <div
                            class="text-base font-semibold text-gray-900 dark:text-gray-400"
                        >
                            {{ user.name }}
                        </div>
                    </div>
                </div>
                <template #body>
                    <div class="data-table">
                        <div>
                            <table>
                                <tbody>
                                    <tr>
                                        <td>{{ $t("users.email") }}</td>
                                        <td>{{ user.email }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $t("users.type") }}</td>
                                        <td>
                                            <span v-if="user.type == 1">{{
                                                $t("users.admin")
                                            }}</span>
                                            <span v-if="user.type == 2">{{
                                                $t("users.user")
                                            }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $t("users.created") }}</td>
                                        <td>
                                            {{ useFormatDate(user.created_at) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $t("users.active") }}</td>
                                        <td>
                                            <div class="flex items-center">
                                                <label
                                                    :for="
                                                        'item-update-' + user.id
                                                    "
                                                    class="relative flex items-center cursor-pointer switch"
                                                >
                                                    <input
                                                        @change="
                                                            form.post(
                                                                route(
                                                                    'user.active',
                                                                    user.id
                                                                )
                                                            )
                                                        "
                                                        type="checkbox"
                                                        :id="
                                                            'item-update-' +
                                                            user.id
                                                        "
                                                        class="sr-only"
                                                        :checked="user.active"
                                                    />
                                                    <span
                                                        class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"
                                                    ></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ $t("actions") }}</td>
                                        <td>
                                            <span
                                                data-drawer-target="users-drawer"
                                                data-drawer-show="users-drawer"
                                                aria-controls="users-drawer"
                                                data-tooltip-target="edit-tooltip"
                                                class="icon-style me-3"
                                                @click="editAction(user)"
                                            >
                                                <PencilSquareIcon
                                                    class="h-6 w-6"
                                                />
                                            </span>
                                            <Tooltip
                                                id="edit-tooltip"
                                                :title="$t('edit')"
                                            />
                                            <SingleDelete
                                                url="user.destroy"
                                                number="sm"
                                                :id="user.id"
                                            />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </template>
            </Accordion>
            <Paginate
                :length="props.users.data.length"
                :total="props.users.total"
                :links="props.users.links"
            >
                hi
            </Paginate>
        </div>
    </AuthLayout>
</template>
