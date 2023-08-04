<script setup>
// inertiajs and vue
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { InputError, TextInput, InputLabel } from "@/Components/Form/Form.js";
import { Button } from "flowbite-vue";
const passwordInput = ref(null);
const currentPasswordInput = ref(null);

// password form data
const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});

// update Password action
const updatePassword = () => {
    form.put(route("password.update"), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset("password", "password_confirmation");
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset("current_password");
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <!-- Update password component -->
    <div
        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800"
    >
        <!-- component title -->
        <h3 class="mb-4 text-sm md:text-lg font-semibold dark:text-white">
            {{ $t("profile.password information") }}
        </h3>

        <form @submit.prevent="updatePassword">
            <div class="grid grid-cols-6 gap-6">
                <!-- current password -->
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel
                        for="current_password"
                        :value="$t('profile.current')"
                    />

                    <TextInput
                        id="current_password"
                        ref="currentPasswordInput"
                        v-model="form.current_password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="current-password"
                    />

                    <InputError
                        :message="form.errors.current_password"
                        class="mt-2"
                    />
                </div>

                <!-- password -->
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="password" :value="$t('profile.new')" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="new-password"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <!-- password confirmation -->
                <div class="col-span-6 sm:col-span-3">
                    <InputLabel
                        for="password_confirmation"
                        :value="$t('profile.confirm')"
                    />

                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="new-password"
                    />

                    <InputError
                        :message="form.errors.password_confirmation"
                        class="mt-2"
                    />
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
