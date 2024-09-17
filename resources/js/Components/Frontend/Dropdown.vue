<template>
    <li class="relative" @mouseover="open = true" @mouseleave="open = false">
        <a
            href="javascript:void(0)"
            class="hover:text-secondary font-semibold flex items-center"
        >
            {{ title }}
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
                <li v-for="item in items" :key="item.text">
                    <a
                        :href="item.link"
                        class="min-w-40 block px-4 py-2 hover:bg-primary hover:text-white rounded"
                    >
                        {{ item.text }}
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
            open: false,
        };
    },
};
</script>

<style scoped></style>
