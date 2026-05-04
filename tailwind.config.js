import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                background: "oklch(var(--color-background) / <alpha-value>)",
                primary: "oklch(var(--color-primary) / <alpha-value>)",
                secondary: "oklch(var(--color-secondary) / <alpha-value>)",
                ctext: "oklch(var(--color-ctext) / <alpha-value>)",
                muted: "oklch(var(--color-muted) / <alpha-value>)",
            },
            /*
            colors: {
                primary: {
                    DEFAULT: "#4f46e5",
                    dark: "#818cf8",
                },
                secondary: {
                    DEFAULT: "#ec4899",
                    dark: "#f472b6",
                },
                background: {
                    DEFAULT: "#ffffff",
                    dark: "#1a202c",
                },
                ctext: {
                    DEFAULT: "#1a1a1a",
                    dark: "#ffffff",
                },
                muted: {
                    DEFAULT: "#6b7280",
                    dark: "#9ca3af",
                },
            },*/
        },
    },

    plugins: [forms],
};
