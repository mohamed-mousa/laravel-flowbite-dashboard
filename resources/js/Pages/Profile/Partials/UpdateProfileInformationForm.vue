<script setup>
// inertiajs and vue
import { useForm, usePage } from "@inertiajs/vue3";
import { InputError, TextInput, InputLabel } from "@/Components/Form/Form.js";
import { Button } from "flowbite-vue";

// get auth user data
const user = usePage().props.user;

// password form data
const form = useForm({
    name: user.name,
    email: user.email,
    phone: user.phone,
});
</script>

<template>
    <!-- Update info component -->
    <div
        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
    >
        <!-- component title -->
        <h3 class="mb-4 text-sm md:text-lg font-semibold dark:text-white">
            {{ $t("profile.information") }}
        </h3>
        <form @submit.prevent="form.patch(route('profile.update'))">
            <div class="grid grid-cols-6 gap-6">
                <!-- name -->
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="name" :value="$t('profile.name')" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <!-- email -->
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="email" :value="$t('profile.email')" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <!-- phone -->
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="phone" :value="$t('profile.phone')" />
                    <TextInput
                        id="phone"
                        type="tel"
                        class="mt-1 block w-full"
                        v-model="form.phone"
                        autocomplete="phone"
                    />
                    <InputError class="mt-2" :message="form.errors.phone" />
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
</template>
