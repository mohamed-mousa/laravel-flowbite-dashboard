<script setup>
import Paginate from "./Paginate.vue";
defineProps(["length", "total", "links", "from", "to"]);
</script>

<template>
    <div class="flex-col data-table">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table>
                        <thead>
                            <tr>
                                <slot name="head"></slot>
                            </tr>
                        </thead>
                        <tbody>
                            <slot name="body"></slot>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <h1
            v-if="length < 1"
            class="text-xl text-center py-10 font-semibold text-gray-500 dark:text-gray-300"
        >
            <icon name="hi-solid-information-circle" class="w-7 h-7 mx-auto" />
            {{ $t("no data") }}
        </h1>

        <Paginate :length="length" :total="total" :links="links">
            <slot name="paginate"></slot>
        </Paginate>
    </div>
</template>
