<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { defineProps, ref } from "vue";

const props = defineProps({
    sales: Object,
    customers: Object,
    message: String,
});

const isOpen = ref(false);
const addOrUpdate = ref(true);

function closeModal() {
    isOpen.value = false;
    addOrUpdate.value = true;
}

function openModal() {
    isOpen.value = true;
    addOrUpdate.value = true;
    form.reset();
}

function openEditModal(sale) {
    isOpen.value = true;
    addOrUpdate.value = false;
}

function getToday() {
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth() + 1;
    const day = today.getDate();

    return `${year}-${month < 10 ? "0" + month : month}-${
        day < 10 ? "0" + day : day
    }`;
}

const form = useForm({});

const deleteForm = useForm({
    prod_id: "",
});

const submit = () => {
    if (addOrUpdate.value === true)
        form.post(route("consigned-inventory.store"));
    else form.patch(route("consigned-inventory.update", form.cp_id));

    closeModal();
};

const deleteProduct = (cp_id) => {
    if (confirm("Are you sure you want to delete this order?")) {
        deleteForm.delete(route("consigned-inventory.destroy", cp_id));
    }
};
</script>

<template>
    <Head title="Consigned Inventory" />

    <AuthenticatedLayout>
        <template v-slot:header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0">
                    <h1 class="text-3xl font-bold text-white">Sales</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <button
                        type="button"
                        @click="openModal"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                    >
                        <div class="flex flex-row space-x-2 text-primary">
                            <span>Add New Sale</span>
                            <Icon
                                icon="fluent:add-circle-24-regular"
                                class="h-5 w-5"
                            />
                        </div>
                    </button>
                    <TransitionRoot appear :show="isOpen" as="template">
                        <Dialog
                            as="div"
                            @close="closeModal"
                            class="relative z-10"
                        >
                            <TransitionChild
                                as="template"
                                enter="duration-300 ease-out"
                                enter-from="opacity-0"
                                enter-to="opacity-100"
                                leave="duration-200 ease-in"
                                leave-from="opacity-100"
                                leave-to="opacity-0"
                            >
                                <div
                                    class="fixed inset-0 bg-black bg-opacity-25"
                                />
                            </TransitionChild>
                            <div class="fixed inset-0 overflow-y-auto">
                                <div
                                    class="flex min-h-full items-center justify-center p-4 text-center"
                                >
                                    <TransitionChild
                                        as="template"
                                        enter="duration-300 ease-out"
                                        enter-from="opacity-0 scale-95"
                                        enter-to="opacity-100 scale-100"
                                        leave="duration-200 ease-in"
                                        leave-from="opacity-100 scale-100"
                                        leave-to="opacity-0 scale-95"
                                    >
                                        <DialogPanel
                                            class="w-full max-w-2xl transform rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                        >
                                            <DialogTitle
                                                as="h3"
                                                class="text-lg font-medium leading-6 text-gray-900"
                                            >
                                                Sale Information
                                                <p
                                                    class="mt-1 text-sm text-gray-500"
                                                >
                                                    Please fill out the
                                                    information below.
                                                </p>
                                            </DialogTitle>

                                            <form
                                                @submit.prevent="submit"
                                                class="mt-8"
                                            >
                                                <div
                                                    class="mt-8 pt-8 text-right sm:border-t sm:border-gray-200"
                                                >
                                                    <button
                                                        type="button"
                                                        @click="closeModal"
                                                        class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary/80 focus:ring-offset-2"
                                                    >
                                                        Cancel
                                                    </button>
                                                    <button
                                                        type="submit"
                                                        class="ml-2 inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                                    >
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        </DialogPanel>
                                    </TransitionChild>
                                </div>
                            </div>
                        </Dialog>
                    </TransitionRoot>
                </div>
            </div>
        </template>

        <div class="flex flex-col shadow-lg">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
                >
                    <div
                        class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg"
                    >
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Sale ID
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Date Issued
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Item ID
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Quantity Sold
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Amount Sold
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Customer
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Personnel
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="sale in sales" :key="sale.sale_id">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ sale.sale_id }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ sale.date_issued }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ sale.item_id }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ sale.qty_sold }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ sale.amount_sold }}
                                        </div>
                                    </td>
                                    <td
                                        class="max-w-[16rem] whitespace-nowrap px-6 py-4"
                                    >
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ sale.name }}
                                        </div>
                                        <div
                                            class="truncate text-sm text-gray-500"
                                        >
                                            {{ sale.address }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="h-10 w-10 flex-shrink-0"
                                            >
                                                <img
                                                    class="h-10 w-10 rounded-full"
                                                    src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60"
                                                    alt=""
                                                />
                                            </div>
                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium text-gray-900"
                                                >
                                                    {{ sale.username }}
                                                </div>
                                                <div
                                                    class="text-sm text-gray-500"
                                                >
                                                    {{ sale.role }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="flex flex-row items-center space-x-2 whitespace-nowrap px-6 py-6 text-right text-sm font-medium"
                                    >
                                        <button
                                            type="button"
                                            title="Edit Consigned Product Details"
                                            class="text-primary/80 hover:text-primary"
                                            @click="openEditModal(product)"
                                        >
                                            Edit
                                        </button>
                                        <form
                                            @submit.prevent="
                                                deleteProduct(product.cp_id)
                                            "
                                        >
                                            <button
                                                type="submit"
                                                title="Delete Consigned Product"
                                                class="text-red-700 hover:text-red-900"
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
