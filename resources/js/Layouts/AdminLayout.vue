<template>
    <div class="flex h-screen overflow-hidden ct">
        <!-- Sidebar -->
        <Sidebar
            :sidebarOpen="sidebarOpen"
            @close-sidebar="sidebarOpen = false"
        />
        <!-- Content area -->
        <div
            class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden"
        >
            <Notification v-if="show"></Notification>
            <!-- Site header -->
            <Header
                :sidebarOpen="sidebarOpen"
                @toggle-sidebar="sidebarOpen = !sidebarOpen"
            />

            <main class="grow">
                <!-- <div class="px-4 sm:px-3 lg:px-4 py-4 w-full max-w-9xl mx-auto"> -->
                <slot />
                <!-- </div> -->
            </main>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import Sidebar from "@/Layouts/Admin/Sidebar.vue";
import Header from "@/Layouts/Admin/Header.vue";
import Notification from "@/Layouts/Admin/Notification.vue";

export default {
    name: "Dashboard",
    components: {
        Sidebar,
        Header,
        Notification,
    },
    setup() {
        const sidebarOpen = ref(false);

        return {
            sidebarOpen,
        };
    },
};
</script>
