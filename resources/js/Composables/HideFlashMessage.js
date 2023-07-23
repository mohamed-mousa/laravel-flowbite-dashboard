import { usePage } from "@inertiajs/vue3";

export function useHideFlashMessage() {
    if (usePage().props.flash) {
        setTimeout(() => (usePage().props.flash = ""), 2000)
    }
}
