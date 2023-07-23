import moment from "moment";
import { usePage } from "@inertiajs/vue3";

export function useFormatDate(date) {
    moment.locale(usePage().props.locale);
    const formatted = moment(date).format("YYYY-MM-DD");
    return formatted;
}
