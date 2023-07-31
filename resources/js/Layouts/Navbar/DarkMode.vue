<script setup>
import { useDark, useToggle } from "@vueuse/core";
const isDark = useDark();
const toggleDark = useToggle(isDark);
</script>

<template>
    <Btn
        @click="toggleDark()"
        id="theme-toggle"
        data-tooltip-target="darkmode-tooltip"
        class="darkmode-toggle"
    >
        <icon name="hi-solid-moon" v-if="!isDark" class="w-5 h-5" />
        <icon name="hi-solid-sun" class="w-5 h-5" v-if="isDark" />
    </Btn>

    <Tooltip id="darkmode-tooltip" :title="$t('navbar.toggle mode')" />
</template>
