<template>
    <Head title="Product Management" />
    <AdminLayout>
        <!-- Dashboard actions -->
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <AlertDelete
                v-if="deleteAlertProduct"
                @close="deleteAlertProduct = false"
                @confirm="deleteProductConfirm()"
                :text="deleteAlertProductText"
            ></AlertDelete>
            <!-- Left: Title -->
            <div class="mb-4 sm:mb-0">
                <h1
                    class="text-2xl md:text-3xl text-gray-800 dark:text-gray-100 font-bold"
                >
                    Dashboard
                </h1>
            </div>
            <!-- Right: Actions -->
            <div
                class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2"
            >
                <Button
                    @click.prevent="
                        router.visit('/admin-dashboard/products/create')
                    "
                    :text="'+ Thêm mới sản phẩm'"
                    :color="'blue'"
                ></Button>
            </div>
        </div>
        <div class="mx-auto max-w-screen-xl px-1 pb-3">
            <div
                class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200"
            >
                <Filters
                    :searchPlaceHolder="'Tìm kiếm theo ID, Tên, Mô tả..'"
                    :filters="filters"
                    :currentPage="products.current_page"
                    :dataName="'products'"
                    :sortByFilters="{ dateSort: true, priceSort: true }"
                    :enableFilters="{
                        search: true,
                        dateRange: true,
                        sortBy: true,
                        filterBy: { availability: true, tag: true },
                    }"
                ></Filters>

                <TableProducts
                    :products="products"
                    @deleteProduct="deleteProduct"
                ></TableProducts>

                <PageNavigation :data="products"></PageNavigation>
            </div>
        </div>
    </AdminLayout>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
    props: ["products", "filters"],
    data() {
        return {
            deleteAlertProduct: false,
            deleteAlertProductText: "",
            productId: null,
        };
    },
    methods: {
        deleteProduct(productId) {
            window.scrollTo(0, 0);
            this.deleteAlertProduct = true;
            this.productId = productId;
            this.deleteAlertProductText = `Việc xóa sản phẩm sẽ bị xóa vĩnh viễn khỏi cơ sở dữ liệu. Bạn không thể khôi phục sản phẩm nữa. Bạn có chắc chắn muốn xóa không?`;
            setTimeout(() => (this.deleteAlertProduct = false), 5000);
        },
        deleteProductConfirm() {
            router.delete(`/admin-dashboard/products/${this.productId}`, {
                preserveState: false,
            });
        },
    },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Filters from "../../../Components/Admin/Filters/Filters.vue";
import TableProducts from "../../../Components/Admin/Tables/TableProducts.vue";
import PageNavigation from "../../../Components/Admin/PageNavigation.vue";
import AlertDelete from "../../../Components/Admin/AlertDelete.vue";
import Button from "../../../Components/Admin/Form/Button.vue";
import AdminLayout from "../../../Layouts/AdminLayout.vue";

onMounted(() => {
    initFlowbite();
});
onUpdated(() => {
    initFlowbite();
});
</script>
