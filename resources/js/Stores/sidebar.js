import { defineStore } from "pinia";
import { ref, watch } from "vue";

const getInitialSidebarState = () => {
    const storedState = localStorage.getItem("sidebar");
    return storedState ? JSON.parse(storedState) : false;
};

export const useSidebarStore = defineStore("sidebar", () => {
    const collapsed = ref(getInitialSidebarState());

    const toggle = () => {
        collapsed.value = !collapsed.value;
    };

    const collapse = () => {
        collapsed.value = true;
    };

    const expand = () => {
        collapsed.value = false;
    };

    watch(
        collapsed,
        (value) => {
            localStorage.setItem("sidebar", JSON.stringify(value));
        },
        { immediate: true },
    );

    return {
        collapsed,
        toggle,
        collapse,
        expand,
    };
});
