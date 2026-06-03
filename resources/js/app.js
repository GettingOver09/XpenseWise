import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createPinia } from "pinia";
import { useThemeStore } from "./stores/theme";
import { ZiggyVue } from "ziggy-js";
import Alpine from "alpinejs";

// Keep Alpine for legacy components,
// but Inertia/Vue usually replaces the need for it.
window.Alpine = Alpine;

const appName = import.meta.env.VITE_APP_NAME || "XpenseWise";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,

    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue"),
        ),

    setup({ el, App, props, plugin }) {
        const pinia = createPinia();
        const app = createApp({ render: () => h(App, props) });
        Alpine.start();

        app.use(plugin).use(pinia).use(ZiggyVue, props.initialPage.props.ziggy);

        return app.mount(el);
    },
});
