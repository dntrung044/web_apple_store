<template>
    <Header></Header>
    <!-- <NavBar
            :navMenu="JSON.parse($page.props.mainMenu)"
            @cartOpen="cartClick()"
        ></NavBar> -->
    <slot></slot>
    <Footer></Footer>
</template>
<script>
export default {
    props: ["mainMenu"],
};
</script>

<script setup>
import Header from "@/Components/Frontend/Layouts/Header.vue";
import Footer from "@/Components/Frontend/Layouts/Footer.vue";
</script>
