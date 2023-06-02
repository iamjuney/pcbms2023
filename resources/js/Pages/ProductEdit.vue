<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
    product: Object,
    message: String,
});

const form = useForm({
    prod_name: props.product.prod_name,
    shelf_life: props.product.shelf_life,
    unit: props.product.unit,
    appreciation: props.product.appreciation,
});

const submit = () => {
    form.patch(route("products.update", props.product.prod_id));
};
</script>

<template>
    <Head title="Edit Product" />

    <AuthenticatedLayout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0">
                    <h1 class="text-3xl font-bold text-white">Edit Product</h1>
                </div>
            </div>
        </template>

        <!-- Form section -->
        <div class="rounded-lg bg-white px-5 py-6 shadow-lg sm:px-6">
            <form class="space-y-8 divide-y divide-gray-200" @submit.prevent="submit()">
                <!-- Form fields -->
                <div class="space-y-6 sm:space-y-5">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Product Information
                        </h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Product details and application.
                        </p>
                    </div>
                    <div class="space-y-6 sm:space-y-5">
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="prod_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Product Name
                            </label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <input v-model="form.prod_name" type="text" name="prod_name" required id="prod_name"
                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm" />
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="shelf_life" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Shelf Life
                            </label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <input v-model="form.shelf_life" type="number" name="shelf_life" required id="shelf_life"
                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm" />
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="unit" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Unit
                            </label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <select id="unit" name="unit" required v-model="form.unit" autocomplete="unit"
                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm">
                                    <option value="piece">Piece</option>
                                    <option value="pack">Pack</option>
                                    <option value="bottle">Bottle</option>
                                    <option value="bag">Bag</option>
                                </select>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="appreciation" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Appreciation
                            </label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <input v-model="form.appreciation" type="number" name="appreciation" required
                                    id="appreciation" step="0.01"
                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions section -->
                <div class="pt-5">
                    <div class="flex justify-end">
                        <Link :href="route('products')"
                            class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary/80 focus:ring-offset-2">
                        Cancel
                        </Link>
                        <button type="submit"
                            class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary/80 focus:ring-offset-2">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
