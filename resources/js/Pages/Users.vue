<script setup>
import * as DrawerOption from "@/Components/Drawer/Drawer.js";
import * as Delete from "@/Components/Buttons/Delete.js";
import * as Form from "@/Components/Form/Form.js";
import Export from "@/Components/Export/Export.vue";
import DataTable from "@/Components/Table/DataTable.vue";
import Filter from "@/Components/Filter/Filter.vue";
import Tooltip from "@/Components/Tooltip.vue";
import Badge from "@/Components/Badge.vue";
import { useForm } from "@inertiajs/vue3";
import { reactive } from "vue";
import { AuthLayout, Header, HeaderLi } from "@/Layouts/Layout.js";

import {
    Accordion,
    AccordionPanel,
    AccordionHeader,
    AccordionContent,
    Table,
    TableHead,
    TableBody,
    TableHeadCell,
    TableRow,
    TableCell,
    Button,
    Avatar,
} from "flowbite-vue";
import {
    useFormatDate,
    useMultiSelect,
    useFilter,
} from "@/Composables/Composables.js";

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
useFilter(filter.p, filter, "users");

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
let isEdit = false;

// use multi select composables
const { selected, selectAll } = useMultiSelect(props.users.data);

// reset form data & errors & multi select & is edit
const reset = () => {
    form.reset();
    form.clearErrors();
    selected.value = [];
    isEdit = false;
};

// fill from with data on edit
const editAction = (user) => {
    isEdit = true;
    form.email = user.email;
    form.type = user.type;
    form.active = user.active;
    form.id = user.id;
    form.name = user.name;
};

const submit = () => {
    // update user data
    if (isEdit) {
        form.put(route("user.update", form.id), {
            onSuccess() {
                reset();
                DrawerOption.useHideDrawer();
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
</script>

<template>
    <!-- browser title -->
    <Head :title="$t('users.title')" />

    <!-- Auth layout -->
    <AuthLayout>
        <!-- page header -->
        <template #header>
            <Header :white="true" :title="$t('users.title')">
                <!-- page breadcrumb -->
                <template #breadcrumb>
                    <HeaderLi
                        :title="$t('sidebar.dashboard')"
                        :isHome="true"
                        :url="'dashboard'"
                    />
                    <HeaderLi :title="$t('users.title')" :isActive="true" />
                </template>

                <!-- filters and options -->
                <template #filter>
                    <Filter>
                        <!-- search input  -->
                        <template #input>
                            <Form.TextInput
                                v-model="filter.keyword"
                                type="text"
                                :placeholder="$t('users.search')"
                            />
                        </template>

                        <!-- options -->
                        <template #options>
                            <Delete.MultiDelete
                                url="users.destroy"
                                :ids="selected"
                                @deleted="reset()"
                            />

                            <Export
                                pdf="users.pdf"
                                excel="users.export"
                                :data="selected"
                            />
                        </template>
                    </Filter>
                </template>

                <!-- create button and form -->
                <template #button>
                    <!-- create button -->
                    <DrawerOption.DrawerButton
                        :title="$t('create')"
                        drawer="users-drawer"
                        @click="reset"
                    >
                        <icon name="hi-plus" class="h-5 w-5 me-1" />
                    </DrawerOption.DrawerButton>

                    <!-- Drawer form -->
                    <DrawerOption.Drawer
                        id="users-drawer"
                        :title="isEdit ? $t('edit') : $t('create')"
                    >
                        <form @submit.prevent="submit">
                            <!-- name -->
                            <div class="mb-4">
                                <Form.TextInput
                                    type="text"
                                    v-model="form.name"
                                    :error="form.errors.name"
                                    required
                                    :placeholder="$t('users.username')"
                                    autocomplete="name"
                                />
                                <Form.InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>

                            <!-- email -->
                            <div class="mb-4">
                                <Form.TextInput
                                    type="email"
                                    v-model="form.email"
                                    required
                                    autocomplete="email"
                                    :placeholder="$t('users.email')"
                                    :error="form.errors.email"
                                />
                                <Form.InputError
                                    class="mt-2"
                                    :message="form.errors.email"
                                />
                            </div>

                            <!-- password -->
                            <div class="mb-4">
                                <Form.TextInput
                                    type="password"
                                    v-model="form.password"
                                    :placeholder="$t('users.password')"
                                    :error="form.errors.password"
                                />
                                <Form.InputError
                                    class="mt-2"
                                    :message="form.errors.password"
                                />
                            </div>

                            <!-- type -->
                            <div class="mb-4">
                                <Form.SelectInput
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
                                </Form.SelectInput>
                            </div>

                            <!-- submit btn -->
                            <div class="flex">
                                <Button
                                    type="submit"
                                    :disabled="form.processing"
                                    :loading="form.processing"
                                    >{{ $t("save") }}</Button
                                >

                                <!-- hide Drawer -->
                                <DrawerOption.DrawerCancel
                                    @click="reset()"
                                    drawer="users-drawer"
                                />
                            </div>
                        </form>
                    </DrawerOption.Drawer>
                </template>

                <!-- search badge-->
                <template #badge>
                    <Badge
                        @hide="filter.keyword = null"
                        :title="filter.keyword"
                    />
                </template>
            </Header>
        </template>

        <!-- Data Table -->
        <DataTable
            :length="props.users.data.length"
            :total="props.users.total"
            :links="props.users.links"
        >
            <!-- Data Table in large devices -->
            <template #large>
                <Table class="lg:flex hidden rounded-0">
                    <!-- table head -->
                    <table-head>
                        <!-- select All -->
                        <table-head-cell class="text-center rounded-0">
                            <Form.Checkbox
                                v-model:checked="selectAll"
                                class="w-4 h-4"
                                name="selectAll"
                            />
                        </table-head-cell>

                        <!-- table-head-cell name -->
                        <table-head-cell
                            class="text-start rounded-0"
                            v-for="name in [
                                'users.username',
                                'users.type',
                                'created',
                                'users.active',
                                'actions',
                            ]"
                        >
                            {{ $t(name) }}</table-head-cell
                        >
                    </table-head>

                    <!-- table body -->
                    <table-body>
                        <table-row v-for="user in props.users.data">
                            <!-- select user -->
                            <table-cell class="text-center">
                                <Form.Checkbox
                                    :value="user.id"
                                    class="w-4 h-4"
                                    name="select"
                                    v-model:checked="selected"
                                />
                            </table-cell>

                            <!-- image & name & email -->
                            <table-cell class="flex text-start">
                                <Avatar
                                    size="md"
                                    :img="user.avatar"
                                    class="me-3"
                                    rounded
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
                            </table-cell>

                            <!-- user type -->
                            <table-cell class="text-start">
                                <span v-if="user.type == 1">{{
                                    $t("users.admin")
                                }}</span>
                                <span v-if="user.type == 2">{{
                                    $t("users.user")
                                }}</span>
                            </table-cell>

                            <!-- created at -->
                            <table-cell class="text-start">{{
                                useFormatDate(user.created_at)
                            }}</table-cell>

                            <!-- toggle user status -->
                            <table-cell class="text-start">
                                <div class="flex items-center">
                                    <label
                                        :for="'item-update-' + user.id"
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
                                            :id="'item-update-' + user.id"
                                            class="sr-only"
                                            :checked="user.active"
                                        />
                                        <span
                                            class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"
                                        ></span>
                                    </label>
                                </div>
                            </table-cell>

                            <!-- actions -->
                            <table-cell class="text-start">
                                <!-- edit Action -->
                                <span
                                    data-drawer-target="users-drawer"
                                    data-drawer-show="users-drawer"
                                    aria-controls="users-drawer"
                                    data-tooltip-target="edit-tooltip"
                                    class="icon-style me-3"
                                    @click="editAction(user)"
                                >
                                    <icon
                                        name="fa-pen-square"
                                        class="h-6 w-6"
                                    />
                                </span>
                                <Tooltip
                                    id="edit-tooltip"
                                    :title="$t('edit')"
                                />

                                <!-- Single Delete -->
                                <Delete.SingleDelete
                                    url="user.destroy"
                                    number="lg"
                                    :id="user.id"
                                />
                            </table-cell>
                        </table-row>
                    </table-body>
                </Table>
            </template>

            <!-- Data Table in small devices -->
            <template #small>
                <Accordion always-close class="small-show-accordion">
                    <!-- select All -->
                    <div class="flex items-start pb-5 px-1">
                        <Form.Checkbox
                            v-model:checked="selectAll"
                            class="w-4 h-4"
                            name="selectAll"
                        />
                        <label
                            for="remember"
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-white"
                        >
                            {{ $t("select all") }}
                        </label>
                    </div>
                    <accordion-panel
                        class="panel"
                        v-for="user in props.users.data"
                    >
                        <!-- accordion header -->
                        <accordion-header class="header">
                            <!-- user image & name & select -->
                            <div class="flex items-center justify-start">
                                <Form.Checkbox
                                    :value="user.id"
                                    class="w-4 h-4 me-4"
                                    name="select"
                                    v-model:checked="selected"
                                />
                                <Avatar
                                    size="sm"
                                    :img="user.avatar"
                                    class="me-3"
                                    rounded
                                />
                                <div
                                    class="text-sm font-normal text-gray-900 dark:text-gray-400"
                                >
                                    {{ user.name }}
                                </div>
                            </div>
                        </accordion-header>
                        <accordion-content class="content">
                            <Table>
                                <table-body>
                                    <!-- email -->
                                    <table-row>
                                        <table-cell class="text-start">{{
                                            $t("users.email")
                                        }}</table-cell>
                                        <table-cell>{{
                                            user.email
                                        }}</table-cell>
                                    </table-row>

                                    <!-- type -->
                                    <table-row>
                                        <table-cell class="text-start">{{
                                            $t("users.type")
                                        }}</table-cell>
                                        <table-cell>
                                            <span v-if="user.type == 1">{{
                                                $t("users.admin")
                                            }}</span>
                                            <span v-if="user.type == 2">{{
                                                $t("users.user")
                                            }}</span>
                                        </table-cell>
                                    </table-row>

                                    <!-- created at -->
                                    <table-row>
                                        <table-cell class="text-start">{{
                                            $t("created")
                                        }}</table-cell>
                                        <table-cell>
                                            {{ useFormatDate(user.created_at) }}
                                        </table-cell>
                                    </table-row>

                                    <!-- status -->
                                    <table-row>
                                        <table-cell class="text-start">{{
                                            $t("users.active")
                                        }}</table-cell>
                                        <table-cell>
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
                                        </table-cell>
                                    </table-row>

                                    <!-- actions -->
                                    <table-row>
                                        <table-cell class="text-start">{{
                                            $t("actions")
                                        }}</table-cell>
                                        <table-cell>
                                            <!-- edit Action -->
                                            <span
                                                data-drawer-target="users-drawer"
                                                data-drawer-show="users-drawer"
                                                aria-controls="users-drawer"
                                                data-tooltip-target="edit-tooltip"
                                                class="icon-style me-3"
                                                @click="editAction(user)"
                                            >
                                                <icon
                                                    name="fa-pen-square"
                                                    class="h-6 w-6"
                                                />
                                            </span>
                                            <Tooltip
                                                id="edit-tooltip"
                                                :title="$t('edit')"
                                            />

                                            <!-- Single Delete -->
                                            <Delete.SingleDelete
                                                url="user.destroy"
                                                number="sm"
                                                :id="user.id"
                                            />
                                        </table-cell>
                                    </table-row>
                                </table-body>
                            </Table>
                        </accordion-content>
                    </accordion-panel>
                </Accordion>
            </template>

            <!-- Data Table paginate -->
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
    </AuthLayout>
</template>
