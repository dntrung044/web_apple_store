<template>
    <li
        class="relative"
        @mouseover="open = true"
        @mouseleave="open = false"
        v-for="category in categories"
        :key="category.id"
    >
        <a
            href="javascript:void(0)"
            class="hover:text-secondary font-semibold flex items-center"
        >
            {{ category.name }}
        </a>
        <transition
            enter-active-class="transition ease-out duration-100"
            enter-from-class="opacity-0 scale-90"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition ease-in duration-100"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-90"
        >
            <ul
                v-if="open"
                class="absolute left-0 bg-white text-black space-y-2 mt-1 p-2 rounded shadow-lg"
            >
                <li v-for="child in category.children" :key="child.id">
                    <a
                        :href="`/path/${createSlug(child.name)}`"
                        class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded"
                    >
                        {{ child.name }}
                    </a>
                </li>
            </ul>
        </transition>
    </li>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        items: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            categories: this.$page.props.product_categories,
            open: false,
        };
    },
    methods: {
        createSlug(text) {
            return text
                .toString()
                .toLowerCase()
                .replace(/\s+/g, "-") // Thay thế khoảng trắng bằng dấu gạch ngang
                .replace(/[^\w\-]+/g, "") // Xóa ký tự không phải là chữ cái, số hoặc dấu gạch ngang
                .replace(/\-\-+/g, "-") // Thay thế nhiều dấu gạch ngang liên tiếp bằng một dấu gạch ngang
                .replace(/^-+/, "") // Xóa dấu gạch ngang ở đầu chuỗi
                .replace(/-+$/, ""); // Xóa dấu gạch ngang ở cuối chuỗi
        },
    },
};
</script>

<style scoped></style>
