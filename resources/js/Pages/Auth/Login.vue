<script setup>
import NotAuthLayout from "@/Layouts/NotAuthLayout.vue";
import {
    InputError,
    TextInput,
    InputLabel,
    Checkbox,
} from "@/Components/Form/Form.js";
import { Button } from "flowbite-vue";
import { useForm } from "@inertiajs/vue3";
import SetLang from "@/Layouts/Navbar/SetLang.vue";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <NotAuthLayout>
        <Head :title="$t('login.title')" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ $t("login.title") }}
        </h2>
        <form class="mt-8 space-y-6" @submit.prevent="submit">
            <!-- email -->
            <div>
                <InputLabel for="email" :value="$t('login.email')" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <!-- password -->
            <div class="mt-4">
                <InputLabel for="password" :value="$t('login.password')" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <!-- remember -->
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                </div>
                <div class="ms-3 text-sm">
                    <label
                        for="remember"
                        class="font-medium text-gray-900 dark:text-white"
                    >
                        {{ $t("login.remember") }}</label
                    >
                </div>
            </div>

            <!-- submit button -->
            <div class="flex justify-between items-center">
                <Button
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    :loading="form.processing"
                    >{{ $t("login.button") }}</Button
                >
                <SetLang />
            </div>
        </form>
    </NotAuthLayout>
</template>
