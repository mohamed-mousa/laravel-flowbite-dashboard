import { watch } from 'vue'
import { router } from "@inertiajs/vue3";
import { debounce, pickBy } from "lodash";
import _ from 'lodash';
export function useFilter(filter, url) {
    watch(
        filter,
        debounce(function () {
            router.get(route(url), pickBy(filter), {
                preserveState: true,
                preserveScroll: true,
            });
        }, 500)
    );

    return { filter, url }
}
