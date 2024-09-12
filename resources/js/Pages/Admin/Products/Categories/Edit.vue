<template>
    <section
        class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1"
    >
        <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
            <!-- Modal content -->

            <Breadcrump
                :links="{ 'Danh mục': 'categories', 'Chỉnh sửa': '' }"
            ></Breadcrump>
            <AlertDelete
                v-if="deleteAlertCategory"
                @close="deleteAlertCategory = false"
                @confirm="deleteCategoryConfirm()"
                :text="deleteAlertCategoryText"
            ></AlertDelete>

            <div
                class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
            >
                <!-- Modal header -->
                <ModalHeader
                    :heading="`Chỉnh sửa danh mục - #${category.id}`"
                    :url="$page.url"
                ></ModalHeader>
                <!-- Modal body -->
                <form action="#" @submit.prevent="">
                    <div>
                        <div class="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                            <div class="pr-5 border-r">
                                <p
                                    class="font-medium text-blue-600 dark:text-gray-400 my-4"
                                >
                                    Chi tiết danh mục:
                                </p>
                                <div class="grid gap-4">
                                    <FormInput
                                        :label="'Tên danh mục'"
                                        :name="'category_name'"
                                        :type="'text'"
                                        :error="errors?.name || ''"
                                        @change="changeNameToSlug"
                                        v-model="categoryInfo.name"
                                    ></FormInput>
                                    <FormInput
                                        :label="'Đường dẫn'"
                                        :name="'category_slug'"
                                        :type="'text'"
                                        :error="errors?.slug || ''"
                                        @change="changeToSlug()"
                                        v-model="categoryInfo.slug"
                                    ></FormInput>
                                    <FormSelect
                                        v-model="categoryInfo.parent_id"
                                        :label="'Danh mục cha'"
                                        :name="'parent_id'"
                                        :selected="categoryInfo.id"
                                        :optionsArray="parent_categories"
                                        :optionName="'name'"
                                        :optionValue="'id'"
                                    >
                                    </FormSelect>
                                    <FormSelect
                                        :label="'Trạng thái'"
                                        :name="'status'"
                                        v-model="categoryInfo.status"
                                        :optionsArray="[
                                            {
                                                value: 'active',
                                                name: 'Kích hoạt',
                                            },
                                            {
                                                value: 'inactive',
                                                name: 'Ẩn',
                                            },
                                        ]"
                                        :optionName="'name'"
                                        :optionValue="'value'"
                                    ></FormSelect>
                                </div>
                            </div>
                            <div class="grid">
                                <div>
                                    <p
                                        class="font-medium text-blue-600 dark:text-gray-400 my-4"
                                    >
                                        Hình ảnh:
                                    </p>

                                    <FormFileUploadSingle
                                        @fileChange="
                                            (file) => (this.image = file[0])
                                        "
                                        :label="' Chọn hình ảnh'"
                                        :oldImageLink="categoryInfo.image_url"
                                        :name="'image'"
                                        :error="errors?.image || ''"
                                    ></FormFileUploadSingle>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <Errors :errors="errors ?? false"></Errors>
                        <div class="flex items-center space-x-4">
                            <Button
                                @click.prevent="updateCategory()"
                                :text="'Cập nhập'"
                                :color="'blue'"
                            ></Button>
                            <Button
                                @click.prevent="deleteCategory()"
                                :text="'Xoá danh mục'"
                                :disableFlash="true"
                                :color="'red'"
                            ></Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
export default {
    props: ["category", "errors", "parent_categories"],
    data() {
        return {
            categoryInfo: this.category,
            form: {},
            deleteAlertCategory: false,
            deleteAlertCategoryText: "",
            image: false,
        };
    },
    methods: {
        slugify(str) {
            return str
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, "")
                .replace(/[\s_-]+/g, "-")
                .replace(/^-+|-+$/g, "");
        },
        changeNameToSlug() {
            this.categoryInfo.slug = this.slugify(this.categoryInfo.name);
        },
        changeToSlug() {
            if (this.categoryInfo.slug !== "") {
                this.categoryInfo.slug = this.slugify(this.categoryInfo.slug);
            } else {
                this.categoryInfo.slug = this.slugify(this.categoryInfo.name);
            }
        },
        deleteCategory() {
            window.scrollTo(0, 0);
            this.deleteAlertCategory = true;
            this.deleteAlertCategoryText = `Bạn có chắc muốn xóa?`;
            setTimeout(() => (this.deleteAlertCategory = false), 8000);
        },
        deleteCategoryConfirm() {
            router.delete(`/dashboard/product_categories/${this.category.id}`, {
                preserveState: false,
            });
        },
        updateCategory() {
            if (this.image) {
                this.categoryInfo.image = this.image;
            } else {
                delete this.categoryInfo.image;
            }
            console.log(this.categoryInfo);
            this.categoryInfo._method = "put";
            router.post(
                `/dashboard/product_categories/${this.category.id}`,
                this.categoryInfo,
                {
                    preserveState: true,
                    only: ["category", "flash", "errors"],
                    preserveScroll: true,
                }
            );
        },
    },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import Breadcrump from "@/Components/Admin/Breadcrump.vue";
import ModalHeader from "@/Components/Admin/ModalHeader.vue";
import FormInput from "@/Components/Admin/Form/FormInput.vue";
import FormSelect from "@/Components/Admin/Form/FormSelect.vue";
import FormTextArea from "@/Components/Admin/Form/FormTextArea.vue";
import FormFileUploadSingle from "@/Components/Admin/Form/FormFileUploadSingle.vue";
import Button from "@/Components/Admin/Form/Button.vue";
import Errors from "@/Components/Admin/Form/Errors.vue";
import AlertDelete from "@/Components/Admin/AlertDelete.vue";

onMounted(() => {
    initFlowbite();
});
onUpdated(() => {
    initFlowbite();
});
</script>
