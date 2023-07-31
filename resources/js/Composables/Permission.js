import { usePage } from "@inertiajs/vue3";

export function useCanShow(data) {
    const can = data.includes(usePage().props.user.type)
    return can;
}
