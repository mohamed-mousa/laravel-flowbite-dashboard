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

import { OhVueIcon, addIcons } from "oh-vue-icons";
import { BiFileEarmarkExcelFill, BiFileEarmarkPdfFill, HiSolidDotsVertical, HiPlus, HiSolidUsers, HiSolidChartPie, HiSolidNewspaper, HiSearch, HiSolidCog, HiChevronDown, HiSolidHome, HiChevronRight, HiLogout, BiBox2Fill, HiSolidMoon, HiSolidSun, HiViewList, HiSolidX, HiSolidBell, HiSolidEye, HiCloudUpload, FaPenSquare, HiAdjustments, HiSolidInformationCircle, FaTools, RiLoader2Line, HiSolidTrash } from "oh-vue-icons/icons";
addIcons(BiFileEarmarkExcelFill, BiFileEarmarkPdfFill, HiSolidDotsVertical, HiPlus, HiSolidUsers, HiSolidChartPie, HiSolidNewspaper, HiSearch, HiSolidCog, HiChevronDown, HiSolidHome, HiChevronRight, HiLogout, BiBox2Fill, HiSolidMoon, HiSolidSun, HiViewList, HiSolidX, HiSolidBell, HiSolidEye, HiCloudUpload, FaPenSquare, HiAdjustments, HiSolidInformationCircle, FaTools, RiLoader2Line, HiSolidTrash);
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Header from "@/Layouts/Header/Header.vue";
import HeaderLi from "@/Layouts/Header/HeaderLi.vue";
import ConfirmModel from "@/Components/Modals/ConfirmModal.vue";

import DataTable from "@/Components/Table/DataTable.vue";
import Accordion from "@/Components/Table/Accordion.vue";
import Badge from "@/Components/Badge.vue";
import FlashMessages from "@/Components/FlashMessages.vue";
import Tooltip from "@/Components/Tooltip.vue";
import Checkbox from "@/Components/Form/Checkbox.vue";
import InputError from "@/Components/Form/InputError.vue";
import SelectInput from '@/Components/Form/SelectInput.vue'
import InputLabel from "@/Components/Form/InputLabel.vue";
import Btn from "@/Components/Buttons/Btn.vue";
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import ExportExcel from "@/Components/Buttons/ExportExcel.vue";
import ExportPdf from "@/Components/Buttons/ExportPdf.vue";
import DangerButton from "@/Components/Buttons/DangerButton.vue";
import TextInput from "@/Components/Form/TextInput.vue";
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
            .component("icon", OhVueIcon)
            .component("Checkbox", Checkbox)
            .component("InputError", InputError)
            .component("InputLabel", InputLabel)
            .component("PrimaryButton", PrimaryButton)
            .component("ExportExcel", ExportExcel)
            .component("ExportPdf", ExportPdf)
            .component("DangerButton", DangerButton)
            .component("DataTable", DataTable)
            .component("Accordion", Accordion)
            .component("Badge", Badge)
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
