import "./bootstrap";
import { createApp } from "vue";

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

// Initialize Vue
const app = createApp({});
app.mount("#app");
