<template>
    <li
        class="pl-4 pr-3 py-2 rounded-lg mb-0.5 last:mb-0 bg-[linear-gradient(135deg,var(--tw-gradient-stops))]"
        :class="
            activeCondition &&
            'from-violet-500/[0.12] dark:from-violet-500/[0.24] to-violet-500/[0.04]'
        "
    >
        <slot :handleClick="handleClick" :expanded="expanded" />
    </li>
</template>

<script>
import { ref, watch } from "vue";

export default {
    name: "SidebarLinkGroup",
    props: {
        activeCondition: {
            type: Boolean,
            default: false,
        },
    },
    setup(props) {
        const expanded = ref(props.activeCondition);

        const handleClick = () => {
            expanded.value = !expanded.value;
        };

        // Theo dõi sự thay đổi của activeCondition và cập nhật expanded
        watch(
            () => props.activeCondition,
            (newVal) => {
                expanded.value = newVal;
            }
        );

        return {
            expanded,
            handleClick,
        };
    },
};
</script>
