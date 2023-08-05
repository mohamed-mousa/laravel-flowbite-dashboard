<script setup>
import { useDark, useToggle } from "@vueuse/core";
const isDark = useDark();
const toggleDark = useToggle(isDark);
</script>

<template>
    <button
        type="button"
        @click="toggleDark()"
        id="theme-toggle"
        data-tooltip-target="darkmode-tooltip"
        class="icon-style"
    >
        <icon name="hi-moon" v-if="!isDark" class="w-6 h-6" />
        <icon name="hi-sun" class="w-6 h-6" v-if="isDark" />
    </button>

    <Tooltip id="darkmode-tooltip" :title="$t('navbar.toggle mode')" />
</template>
