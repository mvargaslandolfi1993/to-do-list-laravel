import "./bootstrap.js";
import "../css/app.css";
import "primeicons/primeicons.css";

import type { DefineComponent } from "vue"; 
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { ZiggyVue } from "ziggy-js";
// @ts-expect-error
import { Ziggy } from "./ziggy.js";
import PrimeVue from "primevue/config";
import Aura from "@primevue/themes/aura";
import DialogService from "primevue/dialogservice";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob<DefineComponent>("./Pages/**/*.vue", { eager: true }); 

        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue, {
                theme: {
                    preset: Aura,
                    options: {
                        cssLayer: {
                            name: "primevue",
                            order: "tailwind-base, primevue, tailwind-utilities",
                        },
                    },
                },
            })
            .use(DialogService)
            .mount(el);
    },
});
