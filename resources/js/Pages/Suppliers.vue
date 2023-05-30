<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Suppliers" />

    <AuthenticatedLayout>
        <template v-slot:header>
            <h1 class="text-3xl font-bold text-white">Suppliers</h1>
        </template>

        <div class="rounded-lg bg-white px-5 py-6 shadow sm:px-6"></div>
    </AuthenticatedLayout>
</template>
