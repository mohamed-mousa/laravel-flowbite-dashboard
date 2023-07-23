<script setup>
import {
    ArrowLeftOnRectangleIcon,
    Squares2X2Icon,
} from "@heroicons/vue/24/solid";
</script>

<template>
    <!-- view all -->
    <Btn data-dropdown-toggle="apps-dropdown" class="apps-toggle">
        <Squares2X2Icon />
    </Btn>
    <div class="narbar-dropdowns" id="apps-dropdown">
        <div class="title">
            {{ $t("navbar.apps") }}
        </div>
        <div class="app-container">
            <Link :href="route('logout')" as="button" method="post">
                <ArrowLeftOnRectangleIcon />
                <span class="app-title"> Logout </span>
            </Link>
        </div>
    </div>
</template>
