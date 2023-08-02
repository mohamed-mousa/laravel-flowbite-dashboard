<script setup>
import { AuthLayout } from "@/Layouts/Layout.js";
</script>

<template>
    <Head title="Dashboard" />

    <AuthLayout>
        <div class="px-4 pt-6">
            {{ $t("dashboard") }}
        </div>
    </AuthLayout>
</template>
