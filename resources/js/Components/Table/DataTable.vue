<script setup>
import Paginate from "@/Components/Table/Paginate.vue";

defineProps(["length", "total", "links"]);
</script>

<template>
    <slot name="large"></slot>
    <slot name="small"></slot>

    <h1
        v-if="length < 1"
        class="text-xl text-center py-10 font-semibold text-gray-500 dark:text-gray-300"
    >
        <icon name="hi-information-circle" class="w-7 h-7 mx-auto" />
        {{ $t("no data") }}
    </h1>

    <Paginate :length="length" :total="total" :links="links">
        <slot name="paginate"></slot>
    </Paginate>
</template>
