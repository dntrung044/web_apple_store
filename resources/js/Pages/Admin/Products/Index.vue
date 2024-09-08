<template>
    <section
        class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1"
    >
        <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
            <Head title="Product Management" />
            <Breadcrump
                :links="{
                    'Danh sách sản phẩm': 'products',
                }"
            ></Breadcrump>
            <Button
                @click.prevent="router.visit('/dashboard/products/create')"
                :text="'+ Thêm mới sản phẩm'"
                :color="'blue'"
            ></Button>
            <AlertDelete
                v-if="deleteAlertProduct"
                @close="deleteAlertProduct = false"
                @confirm="deleteProductConfirm()"
                :text="deleteAlertProductText"
            ></AlertDelete>

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
        </div>
    </section>
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
            this.deleteAlertProductText = `Xóa sản phẩm sẽ bị xóa vĩnh viễn?`;
            setTimeout(() => (this.deleteAlertProduct = false), 5000);
        },
        deleteProductConfirm() {
            router.delete(`/dashboard/products/${this.productId}`, {
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
import Breadcrump from "../../../Components/Admin/Breadcrump.vue";
onMounted(() => {
    initFlowbite();
});
onUpdated(() => {
    initFlowbite();
});
</script>
