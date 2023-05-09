import fs from 'fs';
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { svelte } from "@sveltejs/vite-plugin-svelte";
import { resolve } from 'path';
const projectRootDir = resolve(__dirname);
import {homedir} from 'os';
import { sveltePreprocess } from 'svelte-preprocess/dist/autoProcess';
import tsconfigPaths from 'vite-tsconfig-paths'

let host = 'laravel-breeze-svelte.test'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        svelte({
            preprocess: sveltePreprocess(),
            onwarn: (warning, handler) => { // WARNING: THIS IS A HACK TO SUPPRESS CONSOLE WARNINGS
                return;
            }
        }),
        tsconfigPaths(),
    ],
    optimizeDeps: {
        include: [
            '@inertiajs/inertia',
            '@inertiajs/svelte',
            '@carbon/charts',
        ]
    },
    resolve: {
        alias: {
            '@': resolve(projectRootDir, 'resources/js'),
            '~': resolve(projectRootDir, 'resources'),
            '@public': resolve(projectRootDir, 'public'),
            '@root': projectRootDir,
        },
        extensions: ['.js', '.svelte', '.json', '.svg'],
    },
    server: detectServerConfig(host),
});


function detectServerConfig(host) {
    let keyPath = resolve(homedir(), `.config/valet/Certificates/${host}.key`)
    let certificatePath = resolve(homedir(), `.config/valet/Certificates/${host}.crt`)

    if (!fs.existsSync(keyPath)) {
        return {}
    }

    if (!fs.existsSync(certificatePath)) {
        return {}
    }

    return {
        hmr: {host},
        host,
        https: {
            key: fs.readFileSync(keyPath),
            cert: fs.readFileSync(certificatePath),
        },
    }
}
