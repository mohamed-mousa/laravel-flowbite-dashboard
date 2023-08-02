import { watch, onMounted } from 'vue'
import { router } from "@inertiajs/vue3";
import { debounce, pickBy } from "lodash";
import _ from 'lodash';
export function useFilter(p, filter, url) {
    watch(
        filter,
        debounce(function () {
            router.get(route(url), pickBy(filter), {
                preserveState: true,
                preserveScroll: true,
            });
        }, 500)
    );

    onMounted(() => {
        if (p) {
            filter.p = p.replace(/\D/g, "");
        } else {
            filter.p = 20;
        }
    });

    return { p, filter, url }
}
