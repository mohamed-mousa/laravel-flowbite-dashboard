<script setup></script>

<template>
    <!-- view all -->
    <Btn data-dropdown-toggle="apps-dropdown" class="apps-toggle">
        <icon name="bi-box2-fill" />
    </Btn>
    <div class="narbar-dropdowns" id="apps-dropdown">
        <div class="title">
            {{ $t("navbar.apps") }}
        </div>
        <div class="app-container">
            <Link :href="route('logout')" as="button" method="post">
                <icon name="hi-logout" />
                <span class="app-title"> Logout </span>
            </Link>
        </div>
    </div>
</template>
