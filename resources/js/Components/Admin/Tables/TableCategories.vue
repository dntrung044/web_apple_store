<template>
    <div class="overflow-x-auto" v-if="categories.data.length">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-4 py-3">ID</th>
                    <th scope="col" class="px-4 py-3">Tên</th>
                    <th scope="col" class="px-4 py-3">Ngày tạo</th>
                    <th scope="col" class="px-4 py-3">Trạng thái</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Chức năng</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="border-b dark:border-gray-700"
                    v-for="category in categories.data"
                    :key="category"
                >
                    <th
                        scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        {{ category.id }}
                    </th>
                    <td class="p-4">
                        <div
                            class="w-20 h-20 bg-cover bg-center rounded-lg"
                            :style="`background-image: url(${category.image_url})`"
                        ></div>
                        <p class="font-medium">{{ category.name }}</p>
                    </td>
                    <th scope="row" class="px-4 py-3 font-medium">
                        {{ formatDate(category.created_at) }}
                    </th>
                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-2">
                            <div
                                class="w-2.5 h-2.5 rounded-full"
                                :class="{
                                    'bg-blue-100': category.status === 'null',

                                    'bg-blue-600': category.status === 'active',

                                    'bg-yellow-300':
                                        category.status === 'inactive',
                                }"
                            ></div>
                            <span class="text-sm font-medium">
                                {{
                                    category.status == "inactive"
                                        ? "ẩn"
                                        : "Hiển thị"
                                }}
                            </span>
                        </div>
                    </td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <button
                            :id="`${category.id}-dropdown-button`"
                            :data-dropdown-toggle="`${category.id}-dropdown`"
                            class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                            type="button"
                        >
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="currentColor"
                                viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"
                                />
                            </svg>
                        </button>
                        <div
                            :id="`${category.id}-dropdown`"
                            class="hidden z-auto w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                        >
                            <ul
                                class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                :aria-labelledby="`${category.id}-dropdown-button`"
                            >
                                <li>
                                    <Link
                                        :href="`/dashboard/product_categories/${category.id}/edit`"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >Sửa</Link
                                    >
                                </li>
                            </ul>
                            <div class="py-1">
                                <a
                                    href="#"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                    @click="
                                        $emit('deleteCategory', category.id)
                                    "
                                    >Xoá</a
                                >
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-else class="text-lg px-4 text-gray-500">Dữ liệu danh mục trống!</div>
</template>
<script>
export default {
    props: ["categories"],
    emits: ["deleteCategory"],
    methods: {
        formatDate(date) {
            const options = {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
            };
            return new Intl.DateTimeFormat("vi-VN", options).format(
                new Date(date)
            );
        },
    },
};
</script>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
onMounted(() => {
    initFlowbite();
});
</script>
