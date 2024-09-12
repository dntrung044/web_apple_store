<template>
    <section
        class="dark:bg-gray-900 w-full h-screen overflow-x-hidden md:overflow-x-visible p-1"
    >
        <div class="mx-auto max-w-screen-xl px-1 lg:px-12 pb-10">
            <!-- Start coding here -->
            <h1
                class="text-2xl text-gray-800 mb-2 font-poppins py-3 sm:py-2 font-medium"
            >
                Danh sách danh mục sản phẩm
            </h1>

            <AlertDelete
                v-if="deleteAlertCategory"
                @close="deleteAlertCategory = false"
                @confirm="deleteCategoryConfirm()"
                :text="deleteAlertCategoryText"
            ></AlertDelete>

            <div class="my-2">
                <Button
                    @click.prevent="
                        router.visit('/dashboard/product_categories/create')
                    "
                    :text="'+ Thêm danh mục'"
                    :color="'blue'"
                ></Button>
            </div>

            <div
                class="bg-white dark:bg-gray-800 relative shadow-md rounded-lg border-2 border-gray-200"
            >
                <Filters
                    :searchPlaceHolder="'Tìm kiếm theo ID danh mục hoặc tên'"
                    :filters="filters"
                    :currentPage="categories.current_page"
                    :dataName="'product_categories'"
                    :enableFilters="{
                        search: true,
                    }"
                ></Filters>

                <TableCategories
                    :categories="categories"
                    @deleteCategory="deleteCategory"
                ></TableCategories>

                <PageNavigation :data="categories"></PageNavigation>
            </div>
        </div>
    </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
export default {
    props: ["categories", "filters"],
    data() {
        return {
            deleteAlertCategory: false,
            deleteAlertCategoryText: "",
            categoryId: null,
        };
    },
    methods: {
        deleteCategory(categoryId) {
            window.scrollTo(0, 0);
            this.deleteAlertCategory = true;
            this.categoryId = categoryId;
            this.deleteAlertCategoryText = `Bạn có chắc chắn về xóa không?`;
            setTimeout(() => (this.deleteAlertCategory = false), 8000);
        },
        deleteCategoryConfirm() {
            router.delete(`/dashboard/product_categories/${this.categoryId}`, {
                preserveState: false,
            });
        },
    },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import TableCategories from "@/Components/Admin/Tables/TableCategories.vue";
import Filters from "@/Components/Admin/Filters/Filters.vue";
import PageNavigation from "@/Components/Admin/PageNavigation.vue";
import AlertDelete from "@/Components/Admin/AlertDelete.vue";
import Button from "@/Components/Admin/Form/Button.vue";
import Breadcrump from "@/Components/Admin/Breadcrump.vue";

onMounted(() => {
    initFlowbite();
});
onUpdated(() => {
    initFlowbite();
});
</script>
