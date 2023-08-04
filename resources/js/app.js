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
import { HiSolidDocumentDownload, HiSolidDotsVertical, HiPlus, HiSolidUsers, HiSolidChartPie, HiSolidNewspaper, HiSearch, HiSolidCog, HiChevronDown, HiSolidHome, HiChevronRight, HiLogout, BiBox2Fill, MdDarkmodeRound, HiSolidSun, HiViewList, HiSolidX, HiSolidBell, HiSolidEye, HiCloudUpload, FaPenSquare, HiAdjustments, HiSolidInformationCircle, FaTools, RiLoader2Line, HiSolidTrash, IoCheckmarkDoneCircle } from "oh-vue-icons/icons";
addIcons(HiSolidDocumentDownload, HiSolidDotsVertical, HiPlus, HiSolidUsers, HiSolidChartPie, HiSolidNewspaper, HiSearch, HiSolidCog, HiChevronDown, HiSolidHome, HiChevronRight, HiLogout, BiBox2Fill, MdDarkmodeRound, HiSolidSun, HiViewList, HiSolidX, HiSolidBell, HiSolidEye, HiCloudUpload, FaPenSquare, HiAdjustments, HiSolidInformationCircle, FaTools, RiLoader2Line, HiSolidTrash, IoCheckmarkDoneCircle);
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
    title: (title) => `${title}`,
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
            .component("Head", Head)
            .component("Link", Link)
            .use(i18n)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
