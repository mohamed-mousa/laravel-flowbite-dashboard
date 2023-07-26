import { ref, computed } from 'vue'

export function useMultiSelect(elements) {
    const selected = ref([])

    const selectAll = computed({
        // getter
        get() {
            return elements
                ? selected.value.length == elements.length
                : false;
        },
        // setter
        set(value) {
            let data = [];
            if (value) {
                elements.forEach(function (item) {
                    data.push(item.id);
                });
            }
            selected.value = data;
        },
    });

    return { selected, selectAll, elements }
}
