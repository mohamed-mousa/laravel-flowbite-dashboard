<script setup>
import { WrenchScrewdriverIcon } from "@heroicons/vue/24/outline";
import {
    Drawer,
    DrawerButton,
    DrawerCancel,
    useHideDrawer,
} from "@/Components/Drawer/Drawer.js";
import MultiDelete from "@/Components/Buttons/MultiDelete.vue";
import SingleDelete from "@/Components/Buttons/SingleDelete.vue";
import { useFormatDate } from "@/Composables/FormatDate.js";
import { useMultiSelect } from "@/Composables/MultiSelect.js";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    users: Object,
    filters: Object,
});

const form = useForm({
    email: null,
    password: null,
    type: null,
    name: null,
    id: null,
});

const isEdit = ref(false);

const { selected, selectAll } = useMultiSelect(props.users.data);

const reset = () => {
    form.reset();
    form.clearErrors();
    selected.value = [];
    isEdit.value = false;
};

const editAction = (user) => {
    isEdit.value = true;
    form.email = user.email;
    form.type = user.type;
    form.id = user.id;
    form.name = user.name;
};

const submit = () => {
    if (isEdit.value) {
        form.put(route("user.update", form.id), {
            onSuccess() {
                reset();
                useHideDrawer();
            },
        });
    } else {
        form.post(route("user.store"), {
            onSuccess() {
                reset();
            },
        });
    }
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
                                <MultiDelete
                                    url="users.destroy"
                                    :ids="selected"
                                    @deleted="reset()"
                                />
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
            </Header>
        </template>
        <DataTable :length="props.users.data.length">
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
                <th>{{ $t("users.status") }}</th>
                <th>{{ $t("actions") }}</th>
            </template>
            <template #body>
                <tr v-for="user in props.users.data">
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
                    <td class="flex">
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

                    <td>
                        <span v-if="user.type == 1">{{
                            $t("users.admin")
                        }}</span>
                        <span v-if="user.type == 2">{{
                            $t("users.user")
                        }}</span>
                    </td>
                    <td>
                        {{ useFormatDate(user.created_at) }}
                    </td>

                    <td>
                        <div class="flex items-center">
                            <div
                                v-if="user.status"
                                class="h-3.5 w-3.5 rounded-full bg-green-400 me-2"
                            ></div>
                            <div
                                v-else
                                class="h-3.5 w-3.5 rounded-full bg-red-500 me-2"
                            ></div>
                        </div>
                    </td>
                    <td>
                        <span
                            data-drawer-target="users-drawer"
                            data-drawer-show="users-drawer"
                            aria-controls="users-drawer"
                            data-tooltip-target="edit-tooltip"
                            class="icon-style me-3"
                            @click="editAction(user)"
                        >
                            <WrenchScrewdriverIcon class="h-6 w-6" />
                        </span>
                        <Tooltip id="edit-tooltip" :title="$t('edit')" />
                        <SingleDelete url="user.destroy" :id="user.id" />
                    </td>
                </tr>
            </template>
        </DataTable>
    </AuthLayout>
</template>
