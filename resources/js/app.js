import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from "@inertiajs/vue3";
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    // resolve: (name) => {
    //     const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
    //     let page = pages[`./Pages/${name}.vue`];
    //     // if (name.startsWith("Public/CustomerDashboard/")) {
    //     //     page.default.layout = CustomerDashboardLayout;
    //     // }
    //     // else if (
    //     //     name.startsWith("Public/") ||
    //     //     name.startsWith("Auth/") ||
    //     //     name.startsWith("Cart/") ||
    //     //     name.startsWith("Checkout/")
    //     // ) {
    //     //     page.default.layout = PublicPagesLayout;
    //     // }
    //     if (name.startsWith("AdminDashboard/")) {
    //         page.default.layout = AdminDashboardLayout;
    //     }
    //     return page;
    // },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(plugin)
            .component("Link", Link)
            .component("Head", Head)

            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
