import { defineStore } from "pinia";
import { ref, watch } from "vue";

const getInitialTheme = () => {
    const storedTheme = localStorage.getItem("theme");

    if (storedTheme) return storedTheme;

    return window.matchMedia("(prefers-color-scheme: dark)").matches
        ? "dark"
        : "light";
};

export const useThemeStore = defineStore("theme", () => {
    const theme = ref(getInitialTheme());

    const setTheme = (value) => {
        theme.value = value;
    };

    const toggleTheme = () => {
        theme.value = theme.value === "dark" ? "light" : "dark";
    };

    // sync theme with localStorage + Tailwind's dark class
    watch(
        theme,
        (newTheme) => {
            localStorage.setItem("theme", newTheme);

            document.documentElement.classList.toggle(
                "dark",
                newTheme === "dark",
            );
        },
        { immediate: true },
    );

    return { theme, setTheme, toggleTheme };
});
