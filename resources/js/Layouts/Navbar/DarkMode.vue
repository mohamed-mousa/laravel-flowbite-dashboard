<script setup>
import { MoonIcon, SunIcon } from "@heroicons/vue/24/outline";
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
        <MoonIcon v-if="!isDark" class="w-5 h-5" />
        <SunIcon class="w-5 h-5" v-if="isDark" />
    </Btn>

    <Tooltip id="darkmode-tooltip" :title="$t('navbar.toggle mode')" />
</template>
