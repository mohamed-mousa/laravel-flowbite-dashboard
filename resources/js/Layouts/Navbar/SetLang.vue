<script setup>
import { router } from "@inertiajs/vue3";
import { Avatar } from "flowbite-vue";

const setLang = (lang) => {
    document
        .querySelector("html")
        .setAttribute("dir", lang == "ar" ? "rtl" : "ltr");
    document.querySelector("html").setAttribute("lang", lang);

    router.get(route("setlocale", lang));
};
</script>
<template>
    <button
        type="button"
        data-dropdown-toggle="language-dropdown"
        class="icon-style"
    >
        <Avatar
            size="sm"
            :img="
                $i18n.locale == 'ar'
                    ? 'https://img.icons8.com/color/32/sudan-circular.png'
                    : 'https://img.icons8.com/color/32/usa-circular.png'
            "
            rounded
        />
    </button>

    <div
        class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700"
        id="language-dropdown"
    >
        <ul class="py-1" role="none">
            <li>
                <a
                    @click="
                        setLang('ar');
                        $i18n.locale = 'ar';
                    "
                    href="#"
                    class="block ps-2 pe-10 py-1 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem"
                >
                    <div class="inline-flex items-center">
                        <Avatar
                            class="me-2"
                            size="sm"
                            img="https://img.icons8.com/color/32/sudan-circular.png"
                            rounded
                        />
                        عربي
                    </div>
                </a>
            </li>
            <li>
                <a
                    @click="
                        setLang('en');
                        $i18n.locale = 'en';
                    "
                    href="#"
                    class="block ps-2 pe-10 py-1 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem"
                >
                    <div class="inline-flex items-center">
                        <Avatar
                            class="me-2"
                            size="sm"
                            img="https://img.icons8.com/color/32/usa-circular.png"
                            rounded
                        />
                        English
                    </div>
                </a>
            </li>
        </ul>
    </div>
</template>
