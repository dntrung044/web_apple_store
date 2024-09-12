<template>
    <div class="overflow-x-auto" v-if="users.data.length">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-4 py-3">ID</th>
                    <th scope="col" class="px-4 py-3">Họ tên</th>
                    <th scope="col" class="px-4 py-3">Liên hệ</th>
                    <th scope="col" class="px-4 py-3">Ngày</th>
                    <th scope="col" class="px-4 py-3">
                        <span class="sr-only">Chức năng</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="border-b dark:border-gray-700"
                    v-for="user in users.data"
                    :key="user"
                >
                    <td
                        scope="row"
                        class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        {{ user.id }}
                    </td>
                    <td
                        scope="row"
                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        <img
                            class="w-10 h-10 rounded-full"
                            :src="
                                user.avatar && user.avatar.trim() !== ''
                                    ? user.avatar
                                    : 'https://flowbite.com/docs/images/people/profile-picture-5.jpg'
                            "
                            alt="avatar image"
                        />
                        <div class="pl-3">
                            <div class="text-base font-semibold">
                                {{ user.name }}
                            </div>
                            <div class="font-normal text-gray-500">
                                {{ user.role }}
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        {{ user.email }}
                        {{ user.phone_number }}
                        {{ user.address }}
                    </td>
                    <td scope="row" class="px-4 py-3 font-medium">
                        {{ formatDate(user.created_at) }}
                    </td>
                    <td class="px-4 py-3 flex items-center justify-end">
                        <!-- v-if="user.email !== $page.props.auth.email" -->
                        <button
                            :id="`${user.id}-dropdown-button`"
                            :data-dropdown-toggle="`${user.id}-dropdown`"
                            v-if="
                                user?.email &&
                                $page.props.auth?.email &&
                                user.email !== $page.props.auth.email
                            "
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
                        <span
                            v-else
                            class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300"
                            >Người dùng hiện tại</span
                        >
                        <div
                            :id="`${user.id}-dropdown`"
                            class="hidden z-auto w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                        >
                            <ul
                                class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                :aria-labelledby="`${user.id}-dropdown-button`"
                            >
                                <li>
                                    <Link
                                        :href="`/dashboard/users/${user.id}`"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >Chi tiết</Link
                                    >
                                </li>
                                <li>
                                    <Link
                                        :href="`/dashboard/users/${user.id}/edit`"
                                        class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                        >Chi tiết</Link
                                    >
                                </li>
                            </ul>
                            <div class="py-1">
                                <a
                                    href="#"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                    @click="$emit('deleteUser', user.id)"
                                    >Xoá</a
                                >
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div v-else class="text-lg px-4 text-gray-500">Dữ liệu trống!</div>
</template>
<script>
export default {
    props: ["users"],
    emits: ["deleteUser"],
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
