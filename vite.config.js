import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import Components from "unplugin-vue-components/vite";
import { PrimeVueResolver } from "@primevue/auto-import-resolver";
import path from "path";

export default defineConfig({
    resolve: {
        alias: {
            "ziggy-js": path.resolve("vendor/tightenco/ziggy"),
        },
    },
    plugins: [
        vue(),
        Components({
            resolvers: [PrimeVueResolver()],
        }),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.ts"],
            refresh: true,
        }),
    ],
});
