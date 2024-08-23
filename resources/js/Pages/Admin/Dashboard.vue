<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Card1 from "@/Layouts/Admin/Dashboard/Card1.vue";
import Card2 from "@/Layouts/Admin/Dashboard/Card2.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard admin" />
    <AdminLayout>
        <div class="grid grid-cols-12 gap-6">
            <Card1 />
            <Card2 />
        </div>
    </AdminLayout>
</template>
