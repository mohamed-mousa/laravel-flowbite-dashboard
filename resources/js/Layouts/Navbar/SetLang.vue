<script setup>
import { router } from "@inertiajs/vue3";
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
        class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
    >
        <img
            class="rounded-full"
            :src="
                $i18n.locale == 'ar'
                    ? 'https://img.icons8.com/color/30/sudan-circular.png'
                    : 'https://img.icons8.com/color/30/usa-circular.png'
            "
            alt="sudan-circular"
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
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem"
                >
                    <div class="inline-flex items-center">
                        <img
                            class="rounded-full me-2"
                            src="https://img.icons8.com/color/30/sudan-circular.png"
                            alt="sudan-circular"
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
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem"
                >
                    <div class="inline-flex items-center">
                        <img
                            class="rounded-full me-2"
                            src="https://img.icons8.com/color/30/usa-circular.png"
                            alt="usa-circular"
                        />
                        English (US)
                    </div>
                </a>
            </li>
        </ul>
    </div>
</template>
