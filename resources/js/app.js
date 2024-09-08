import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from "@inertiajs/vue3";
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import AdminDashboardLayout from "./Layouts/AdminLayout.vue";
import HomeLayout from "./Layouts/HomeLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || 'VLIT STACK';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        if (name.startsWith("Home/")) {
            page.default.layout = HomeLayout;
        }
        // else if (
        //     name.startsWith("Auth/") ||
        //     name.startsWith("Cart/") ||
        //     name.startsWith("Checkout/")
        // ) {
        //     page.default.layout = HomeLayout;
        // }
        if (name.startsWith("Admin/")) {
            page.default.layout = AdminDashboardLayout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
