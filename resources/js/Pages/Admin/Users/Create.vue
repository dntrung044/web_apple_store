<template>
    <section
        class="dark:bg-gray-900 h-screen overflow-x-hidden md:overflow-x-visible p-1"
    >
        <div class="mx-auto max-w-screen-xl px-1 lg:px-12 my-11 pb-11">
            <!-- Modal content -->

            <Breadcrump
                :links="{ 'Người dùng': 'users', Tạo: '' }"
            ></Breadcrump>

            <div
                class="relative p-4 bg-white border border-gray-200 rounded-lg shadow dark:border-gray-700 dark:bg-gray-800 sm:p-5"
            >
                <!-- Modal header -->
                <ModalHeader
                    :heading="'Tạo người dùng'"
                    :url="$page.url"
                ></ModalHeader>

                <!-- Modal body -->
                <form action="#" @submit.prevent="">
                    <div>
                        <div class="mb-4">
                            <div class="grid gap-4 mb-4 sm:grid-cols-5">
                                <div class="grid sm:col-span-3 pr-4 border-r">
                                    <!-- product general details  -->
                                    <div>
                                        <p
                                            class="font-medium text-blue-600 dark:text-gray-400 my-4"
                                        >
                                            Tạo người dùng:
                                        </p>
                                        <div class="grid gap-4 sm:grid-cols-2">
                                            <FormInput
                                                :label="'Họ tên'"
                                                :name="'name'"
                                                :type="'text'"
                                                v-model="userInfo.name"
                                            ></FormInput>
                                            <FormInput
                                                :label="'Địa chỉ'"
                                                :name="'address'"
                                                :type="'text'"
                                                v-model="userInfo.address"
                                            ></FormInput>
                                        </div>
                                        <div class="grid gap-4 sm:grid-cols-2">
                                            <FormInput
                                                :label="'Địa chỉ Email'"
                                                :name="'email'"
                                                :type="'email'"
                                                v-model="userInfo.email"
                                            ></FormInput>
                                            <FormInput
                                                :label="'Số điện thọai'"
                                                :name="'phone_number'"
                                                :type="'number'"
                                                v-model="userInfo.phone_number"
                                            ></FormInput>
                                        </div>
                                        <div class="grid gap-4 sm:grid-cols-2">
                                            <FormInput
                                                :label="'Ngày sinh'"
                                                :name="'birthday'"
                                                :type="'date'"
                                                v-model="userInfo.birthday"
                                            ></FormInput>
                                            <FormInput
                                                :label="'Giới tính'"
                                                :name="'gender'"
                                                :type="'text'"
                                                v-model="userInfo.gender"
                                            ></FormInput>
                                        </div>
                                        <div class="grid gap-4 sm:grid-cols-2">
                                            <FormInput
                                                :label="'Mật khẩu'"
                                                :name="'password'"
                                                :type="'password'"
                                                v-model="userInfo.password"
                                            ></FormInput>
                                            <FormInput
                                                :label="'Xác nhận mật khẩu'"
                                                :name="'confirm_password'"
                                                :type="'password'"
                                                v-model="
                                                    userInfo.password_confirmation
                                                "
                                            ></FormInput>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid sm:col-span-2">
                                    <div>
                                        <p
                                            class="font-medium text-blue-600 dark:text-gray-400 my-4"
                                        >
                                            Ảnh đại diện:
                                        </p>

                                        <FormFileUploadSingle
                                            @fileChange="
                                                (file) =>
                                                    (userInfo.avatar = file[0])
                                            "
                                            :label="'Thêm ảnh đại diện'"
                                            :name="'avatar'"
                                        ></FormFileUploadSingle>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <Errors :errors="errors ?? false"></Errors>
                        <div class="flex items-center space-x-4">
                            <Button
                                @click.prevent="createUser()"
                                :text="'Thêm người dùng'"
                                :color="'blue'"
                            ></Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
import { useForm } from "@inertiajs/vue3";
export default {
    props: ["errors"],
    data() {
        return {
            userInfo: {},
            form: {},
        };
    },
    methods: {
        createUser() {
            console.log(this.userInfo);
            this.form = useForm(this.userInfo);
            this.form.post(`/dashboard/users`, {
                preserveScroll: true,
            });
        },
    },
};
</script>
<script setup>
import { onMounted, onUpdated } from "vue";
import { initFlowbite } from "flowbite";
import FormFileUploadSingle from "@/Components/Admin/Form/FormFileUploadSingle.vue";
import Breadcrump from "@/Components/Admin/Breadcrump.vue";
import ModalHeader from "@/Components/Admin/ModalHeader.vue";
import FormInput from "@/Components/Admin/Form/FormInput.vue";
import Button from "@/Components/Admin/Form/Button.vue";
import Errors from "@/Components/Admin/Form/Errors.vue";
import { QuillEditor } from "@vueup/vue-quill";

onMounted(() => {
    initFlowbite();
});
onUpdated(() => {
    initFlowbite();
});
</script>
