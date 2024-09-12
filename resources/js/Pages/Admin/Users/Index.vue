<template>
    <section
        class="dark:bg-gray-900 w-full h-screen overflow-x-hidden md:overflow-x-visible p-1"
    >
        <div class="mx-auto max-w-screen-xl px-1 lg:px-12 pb-10">
            <!-- Start coding here -->
            <Head title="Quản lý tài khoản" />
            <Breadcrump
                :links="{
                    'Danh sách tài khoản': 'users',
                }"
            ></Breadcrump>
            <AlertDelete
                v-if="deleteAlertUser"
                @close="deleteAlertUser = false"
                @confirm="deleteUserConfirm()"
                :text="deleteAlertUserText"
            ></AlertDelete>

            <div class="my-2">
                <Button
                    @click.prevent="router.visit('/dashboard/users/create')"
                    :text="'+ Thêm tài khoản'"
                    :color="'blue'"
                ></Button>
            </div>

            <div
                class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200"
            >
                <Filters
                    :filters="filters"
                    :searchPlaceHolder="'Tìm kiếm theo ID người dùng/Tên/Email/Số điện thoại..'"
                    :currentPage="users.current_page"
                    :dataName="'users'"
                    :enableFilters="{
                        search: true,
                        dateRange: true,
                        sortBy: true,
                    }"
                    :sortByFilters="{ dateSort: true }"
                ></Filters>

                <TableUsers
                    :users="users"
                    @deleteUser="deleteUser"
                ></TableUsers>

                <PageNavigation :data="users"></PageNavigation>
            </div>
        </div>
    </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
    props: ["users", "filters"],
    data() {
        return {
            deleteAlertUser: false,
            deleteAlertUserText: "",
            userId: null,
        };
    },
    methods: {
        deleteUser(userId) {
            window.scrollTo(0, 0);
            this.deleteAlertUser = true;
            this.userId = userId;
            this.deleteAlertUserText = `Deleting the user will permanently removed from the database. You can't recover the
        user again. Are you sure about deleting?`;
            setTimeout(() => (this.deleteAlertUser = false), 5000);
        },
        deleteUserConfirm() {
            router.delete(`/dashboard/users/${this.userId}`, {
                preserveState: false,
            });
        },
    },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";

import Filters from "@/Components/Admin/Filters/Filters.vue";
import TableUsers from "@/Components/Admin/Tables/TableUsers.vue";
import PageNavigation from "@/Components/Admin/PageNavigation.vue";
import AlertDelete from "@/Components/Admin/AlertDelete.vue";
import Button from "@/Components/Admin/Form/Button.vue";
import Breadcrump from "@/Components/Admin/Breadcrump.vue";
import ModalHeader from "@/Components/Admin/ModalHeader.vue";
onMounted(() => {
    initFlowbite();
});
onUpdated(() => {
    initFlowbite();
});
</script>
