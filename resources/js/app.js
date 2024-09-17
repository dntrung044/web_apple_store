import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head } from "@inertiajs/vue3";
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import DashboardLayout from "@/Layouts/AdminLayout.vue";
import FrontendLayout from "@/Layouts/FrontendLayout.vue";

const appName = import.meta.env.VITE_APP_NAME || 'VLIT STACK';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];

        if (!page) {
            // Xử lý trường hợp không tìm thấy mô-đun trang
            console.error(`Không tìm thấy mô-đun trang cho ${name}`);
            return { default: null }; // hoặc mô-đun mặc định / dự phòng nào đó
        }

        if (name.startsWith("Frontend/")) {
            page.default.layout = FrontendLayout;
        }
        // else if (
        //     name.startsWith("Auth/") ||
        //     name.startsWith("Cart/") ||
        //     name.startsWith("Checkout/")
        // ) {
        //     page.default.layout = PublicLayout;
        // }
        if (name.startsWith("Admin/")) {
            page.default.layout = DashboardLayout;
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