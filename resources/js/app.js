import './bootstrap';
import '../css/app.css';

import { createInertiaApp } from "@inertiajs/svelte";
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { InertiaProgress } from "@inertiajs/progress";

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "DramaQuick";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.svelte`, import.meta.glob('./Pages/**/*.svelte')),
    setup({ el, App, props }) {
        new App({ target: el, props });
    },
});

InertiaProgress.init({ color: "#34ffad" });
