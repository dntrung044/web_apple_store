<template>
    <li class="relative group">
        <a
            v-for="category in categories"
            :key="category.id"
            @click="open = !open"
            class="hover:text-secondary font-bold py-2 flex justify-center items-center cursor-pointer"
        >
            <span> {{ category.name }}</span>
        </a>
        <ul v-if="(open = false)" class="mobile-dropdown-menu space-y-2">
            <li v-for="child in category.children" :key="child.id">
                <a
                    :href="`/path/${createSlug(child.name)}`"
                    class="hover:text-secondary font-bold block pt-2 pb-3"
                >
                    {{ child.name }}
                </a>
            </li>
        </ul>
    </li>

    <ul>
        <li
            class="relative"
            @mouseover="openCategory(category.id)"
            @mouseleave="closeCategory(category.id)"
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
                    v-if="openCategories.includes(category.id)"
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
    </ul>
</template>

<script>
export default {
    props: {
        categories: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            openCategories: [],
        };
    },
    methods: {
        openCategory(id) {
            if (!this.openCategories.includes(id)) {
                this.openCategories.push(id);
            }
        },
        closeCategory(id) {
            this.openCategories = this.openCategories.filter(
                (categoryId) => categoryId !== id
            );
        },
        createSlug(text) {
            return text
                .toString()
                .toLowerCase()
                .replace(/\s+/g, "-")
                .replace(/[^\w\-]+/g, "")
                .replace(/\-\-+/g, "-")
                .replace(/^-+/, "")
                .replace(/-+$/, "");
        },
    },
};
</script>
