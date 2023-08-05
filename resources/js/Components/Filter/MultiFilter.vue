<script setup></script>
<template>
    <!-- drawer init and show -->
    <div class="text-center" data-tooltip-target="tooltip-default">
        <span
            class="icon-style"
            data-drawer-target="multi-filter"
            data-drawer-show="multi-filter"
            aria-controls="multi-filter"
        >
            <icon name="hi-adjustments" class="h-6 w-6" />
        </span>
    </div>
    <div
        id="tooltip-default"
        role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700"
    >
        فلتر متعدد
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

    <!-- drawer component -->
    <div
        id="multi-filter"
        class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1"
        aria-labelledby="multi-filter-label"
    >
        <h5
            id="drawer-label"
            class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400"
        >
            <icon name="hi-adjustments" class="w-6 h-6 me-2.5" />
            بحث متعدد
        </h5>
        <button
            type="button"
            data-drawer-hide="multi-filter"
            aria-controls="multi-filter"
            class="absolute top-2.5 end-2.5 icon-style"
        >
            <icon name="hi-x" class="w-6 h-6" />
            <span class="sr-only">Close menu</span>
        </button>
        <div class="mb-6">
            <slot></slot>
        </div>
    </div>
</template>
