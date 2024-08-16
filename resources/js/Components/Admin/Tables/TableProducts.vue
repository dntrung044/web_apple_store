<template>
    <div class="overflow-x-auto" v-if="products.data.length">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <th scope="col" class="px-4 py-3">ID</th>
                <th scope="col" class="px-4 py-3">Tên</th>
                <th scope="col" class="px-4 py-3">Danh mục</th>
                <th scope="col" class="px-4 py-3">Giá</th>
                <th scope="col" class="px-4 py-3">kho</th>
                <th scope="col" class="px-4 py-3">Ngày tạo</th>
                <th scope="col" class="px-4 py-3">Trạng thái</th>
                <th scope="col" class="px-4 py-3">
                    <span class="sr-only">Chức năng</span>
                </th>
            </thead>
            <tbody>
                <tr
                    class="border-b dark:border-gray-700"
                    v-for="product in products.data"
                    :key="product"
                >
                    <th
                        scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        {{ product.id }}
                    </th>

                    <th
                        scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        <div class="items-center mr-1">
                            <img
                                :src="`/storage/${product.thumbnail}`"
                                alt="Product Image"
                                class="h-8 w-auto mr-3"
                            />
                            <!-- <div
                            class="w-20 h-20 bg-cover bg-center rounded-lg"
                            :style="`background-image: url(${product.thumbnail})`"
                        ></div> -->
                            <p class="font-medium">{{ product.name }}</p>
                        </div>
                    </th>
                    <td class="px-4 py-3">
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"
                        >
                            {{ product.category.name }}
                        </span>
                    </td>

                    <td class="px-4 py-3">
                        {{ formatCurrency(product.price) }}
                        <!-- <br /> -->
                        <!-- <p class="font-medium">
                            Offer Price: {{ product.price_sale }}
                        </p> -->
                    </td>
                    <td class="px-4 py-3 w-48 text-center align-middle">
                        <div class="flex flex-col items-center">
                            <span
                                class="text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"
                                :class="{
                                    'bg-green-100 text-green-800':
                                        product.availability === 'paid',
                                    'bg-yellow-100 text-yellow-800':
                                        product.availability === 'unpaid',
                                    'bg-blue-100 text-blue-800':
                                        product.availability === 'coming_soon',
                                    'bg-green-600 text-white':
                                        product.availability === 'available',
                                    'bg-red-600 text-white':
                                        product.availability === 'out_of_stock',
                                }"
                            >
                                {{ convertString(product.availability) }}
                            </span>
                            <div class="mt-1 text-center">
                                {{ product.inventory }}
                            </div>
                        </div>
                    </td>

                    <td class="px-4 py-3">
                        {{ formatDate(product.created_at) }}
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex items-center space-x-2">
                            <div
                                class="w-2.5 h-2.5 rounded-full"
                                :class="{
                                    'bg-blue-100': product.status === 'null',

                                    'bg-blue-600': product.status === 'active',

                                    'bg-yellow-300':
                                        product.status === 'inactive',
                                }"
                            ></div>
                            <span class="text-sm font-medium">
                                {{ product.status }}
                            </span>
                        </div>
                    </td>

                    <td class="px-4 py-3 flex items-center justify-end">
                        <button
                            :id="`${product.id}-dropdown-button`"
                            :data-dropdown-toggle="`${product.id}-dropdown`"
                            class="flex items-center"
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
                            :id="`${product.id}-dropdown`"
                            class="hidden z-auto w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                        >
                            <ul
                                class="py-1 text-sm"
                                aria-labelledby="apple-imac-27-dropdown-button"
                            >
                                <li
                                    class="mb-2 text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-300 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:yellow:bg-blue-600 dark:focus:ring-yellow-700"
                                >
                                    <Link
                                        :href="`/admin-dashboard/products/${product.id}/edit`"
                                        class="flex items-center justify-center w-full text-sm font-medium"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 mr-2 -ml-0.5"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"
                                            ></path>
                                            <path
                                                fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                        Sửa
                                    </Link>
                                </li>
                                <li
                                    class="mb-2 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-900"
                                >
                                    <Link
                                        :href="`/admin-dashboard/products/${product.id}`"
                                        class="flex items-center justify-center w-full text-sm font-medium"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-2"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                            ></path>
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            ></path>
                                        </svg>
                                        Chi tiết
                                    </Link>
                                </li>
                                <li
                                    class="mb-2 text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900"
                                >
                                    <button
                                        type="button"
                                        @click="
                                            $emit('deleteProduct', product.id)
                                        "
                                        class="flex items-center justify-center w-full"
                                    >
                                        <svg
                                            class="w-4 h-4 mr-2"
                                            viewBox="0 0 14 15"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            aria-hidden="true"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                clip-rule="evenodd"
                                                fill="currentColor"
                                                d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z"
                                            ></path>
                                        </svg>
                                        <span>Xóa</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-else class="text-lg px-4 text-gray-500">Hiện không có sản phẩm!</div>
</template>
<script>
export default {
    data() {
        return {
            expandedRows: [],
        };
    },
    props: ["products"],
    emits: ["deleteProduct"],
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
        formatCurrency(value) {
            return new Intl.NumberFormat("vi-VN", {
                style: "currency",
                currency: "VND",
            }).format(value);
        },

        convertString(string) {
            var newString = string.split("_").join(" ");
            return newString.charAt(0).toUpperCase() + newString.slice(1);
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
