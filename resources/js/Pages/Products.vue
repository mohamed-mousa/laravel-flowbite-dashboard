<script setup>
import { TrashIcon, PlusIcon } from "@heroicons/vue/24/solid";
import MultiFilter from "@/Components/MultiFilter.vue";
import Drawer from "@/Components/Drawer.vue";
</script>

<template>
    <Head title="users" />

    <AuthLayout>
        <template #header>
            <Header white="true" :title="$t('users')">
                <HeaderLi title="home" isHome="true" url="/" />
                <HeaderLi title="home" url="/" />
                <HeaderLi title="home" isActive="true" />
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
                                <MultiFilter>
                                    <div class="mb-4">
                                        <InputLabel value="ابحث باسم المسخدم" />
                                        <TextInput type="text" />
                                    </div>
                                </MultiFilter>
                                <span class="icon-style">
                                    <TrashIcon class="h-6 w-6" />
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- drawer init and show -->
                    <PrimaryButton
                        title="Add new user"
                        data-drawer-target="users-drawer"
                        data-drawer-show="users-drawer"
                        aria-controls="users-drawer"
                    >
                        <PlusIcon class="h-5 w-5 me-1" />
                    </PrimaryButton>
                    <Drawer id="users-drawer" title="اضافة مستخدم">
                        <div class="mb-4">
                            <TextInput type="text" placeholder="اسم المسخدم" />
                        </div>
                        <PrimaryButton
                            :title="$t('save')"
                            class="ml-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        />
                    </Drawer>
                </template>
            </Header>
        </template>
        {{ $t("users") }}
    </AuthLayout>
</template>
