<script setup></script>

<template>
    <!-- search input in Multi delete btn -->
    <div class="filter-container">
        <div class="sm:pe-3">
            <div class="search-input-container">
                <slot name="input"></slot>
            </div>
        </div>
        <div class="filter-options">
            <div class="filter-inputs">
                <slot name="options"></slot>
            </div>
        </div>
    </div>
</template>
