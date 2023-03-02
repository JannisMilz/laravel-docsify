import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/ts/script.ts"],
            publicDirectory: "./",
            buildDirectory: "public",
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    let extType = assetInfo.name.split(".").at(1);
                    if (/png|jpe?g|svg|gif|tiff|bmp|ico/i.test(extType)) {
                        extType = "img";
                    }
                    return `assets/${extType}/[name][extname]`;
                },
                entryFileNames: `assets/js/[name].js`,
                chunkFileNames: `assets/js/[name].js`,
            },
        },
    },
});
