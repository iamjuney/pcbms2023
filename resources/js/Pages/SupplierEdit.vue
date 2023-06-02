<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
    supplier: Object,
    message: {
        type: String,
    },
});

const form = useForm({
    company: props.supplier.company,
    contact_person: props.supplier.contact_person,
    sex: props.supplier.sex,
    address: props.supplier.address,
    phone: props.supplier.phone,
});

const submit = () => {
    form.patch(route("suppliers.update", props.supplier.supp_id));
};
</script>
<template>
    <Head title="Edit Supplier" />

    <AuthenticatedLayout>
        <template #header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0">
                    <h1 class="text-3xl font-bold text-white">Edit Supplier</h1>
                </div>
            </div>
        </template>

        <div class="rounded-lg bg-white px-5 py-6 shadow-lg sm:px-6">
            <form
                class="space-y-8 divide-y divide-gray-200"
                @submit.prevent="submit()"
            >
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    <div class="space-y-6 sm:space-y-5">
                        <div>
                            <h3
                                class="text-lg font-medium leading-6 text-gray-900"
                            >
                                Supplier Information
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                Personal details and application.
                            </p>
                        </div>
                        <div class="space-y-6 sm:space-y-5">
                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <label
                                    for="company"
                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                >
                                    Company
                                </label>
                                <div class="mt-1 sm:col-span-2 sm:mt-0">
                                    <input
                                        v-model="form.company"
                                        type="text"
                                        name="company"
                                        id="company"
                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:max-w-xs sm:text-sm"
                                    />
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <label
                                    for="contact-person"
                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                >
                                    Contact Person
                                </label>
                                <div class="mt-1 sm:col-span-2 sm:mt-0">
                                    <input
                                        v-model="form.contact_person"
                                        type="text"
                                        name="contact_person"
                                        id="contact_person"
                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:max-w-xs sm:text-sm"
                                    />
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <label
                                    for="sex"
                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                >
                                    Sex
                                </label>
                                <div class="mt-1 sm:col-span-2 sm:mt-0">
                                    <select
                                        v-model="form.sex"
                                        id="sex"
                                        name="sex"
                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:max-w-xs sm:text-sm"
                                    >
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Non-binary">
                                            Non-binary
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <label
                                    for="address"
                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                >
                                    Address
                                </label>
                                <div class="mt-1 sm:col-span-2 sm:mt-0">
                                    <input
                                        v-model="form.address"
                                        type="text"
                                        name="address"
                                        id="address"
                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                    />
                                </div>
                            </div>

                            <div
                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                            >
                                <label
                                    for="phone"
                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                >
                                    Phone
                                </label>
                                <div class="mt-1 sm:col-span-2 sm:mt-0">
                                    <input
                                        v-model="form.phone"
                                        type="text"
                                        name="phone"
                                        id="phone"
                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:max-w-xs sm:text-sm"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <Link
                            :href="route('suppliers')"
                            class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary/80 focus:ring-offset-2"
                        >
                            Cancel
                        </Link>
                        <button
                            type="submit"
                            class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-primary/80 focus:ring-offset-2"
                        >
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
