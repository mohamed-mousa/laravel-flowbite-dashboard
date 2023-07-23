<script setup>
import { TrashIcon } from "@heroicons/vue/24/solid";
import MultiFilter from "@/Components/MultiFilter.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthLayout>
        <div class="px-4 pt-6">
            {{ $t("dashboard") }}
        </div>
    </AuthLayout>
</template>
