import './bootstrap';
import '../css/app.css';
import en from "./lang/en.json";
import ar from "./lang/ar.json";
import { createI18n } from "vue-i18n";
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { Head, Link } from "@inertiajs/vue3";

import AuthLayout from "@/Layouts/AuthLayout.vue";
import Header from "@/Layouts/Header/Header.vue";
import HeaderLi from "@/Layouts/Header/HeaderLi.vue";
import ConfirmModel from "@/Components/Modals/ConfirmModal.vue";

import DataTable from "@/Components/Table/DataTable.vue";
import FlashMessages from "@/Components/FlashMessages.vue";
import Tooltip from "@/Components/Tooltip.vue";
import Checkbox from "@/Components/Form/Checkbox.vue";
import InputError from "@/Components/Form/InputError.vue";
import SelectInput from '@/Components/Form/SelectInput.vue'
import InputLabel from "@/Components/Form/InputLabel.vue";
import Btn from "@/Components/Buttons/Btn.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import DangerButton from "@/Components/Buttons/DangerButton.vue";
import TextInput from "@/Components/Form/TextInput.vue";
import {
    TrashIcon,
    PlusIcon,
} from "@heroicons/vue/24/outline";
const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const messages = {
    en: en,
    ar: ar,
};

createInertiaApp({
    progress: {
        delay: 250,
        color: '#1D4ED8',
        includeCSS: true,
        showSpinner: true,
    },
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const i18n = createI18n({
            locale: props.initialPage.props.locale, // set locale
            fallbackLocale: "ar", // set fallback locale
            messages, // set locale messages
        });
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Checkbox", Checkbox)
            .component("InputError", InputError)
            .component("InputLabel", InputLabel)
            .component("PrimaryButton", PrimaryButton)
            .component("DangerButton", DangerButton)
            .component("DataTable", DataTable)
            .component("TrashIcon", TrashIcon)
            .component("PlusIcon", PlusIcon)
            .component("ConfirmModel", ConfirmModel)
            .component("Btn", Btn)
            .component("TextInput", TextInput)
            .component("SelectInput", SelectInput)
            .component("FlashMessages", FlashMessages)
            .component("Tooltip", Tooltip)
            .component("AuthLayout", AuthLayout)
            .component("Head", Head)
            .component("Link", Link)
            .component("Header", Header)
            .component("HeaderLi", HeaderLi)
            .use(i18n)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
