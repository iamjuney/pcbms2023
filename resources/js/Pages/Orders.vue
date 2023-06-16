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
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
}

function openModal() {
    isOpen.value = true;
}

defineProps({
    orders: Object,
    message: String,
});

const form = useForm({
    or_id: 1,
    supp_id: 1,
    userid: 1,
    order_date: "",
    status: "Pending",
    item_id: 1,
    quantity: 1,
});

// const deleteForm = useForm({
//     product_id: "",
// });

// const submit = () => {
//     form.post(route("products.store"), {
//         onFinish: () => {
//             form.reset("name", "price", "description");
//             closeModal();
//         },
//     });
// };

// const deleteProduct = (prod_id) => {
//     if (confirm("Are you sure you want to delete this product?")) {
//         deleteForm.delete(route("products.destroy", prod_id));
//     }
// };
</script>
<template>
    <Head title="Orders" />

    <AuthenticatedLayout>
        <template v-slot:header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0">
                    <h1 class="text-3xl font-bold text-white">Orders</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <button
                        type="button"
                        @click="openModal"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                    >
                        <div class="flex flex-row space-x-2 text-primary">
                            <span>Add New Product</span>
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
                                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                        >
                                            <DialogTitle
                                                as="h3"
                                                class="text-lg font-medium leading-6 text-gray-900"
                                            >
                                                Order Information
                                            </DialogTitle>

                                            <form
                                                @submit.prevent=""
                                                class="mt-8"
                                            >
                                                <div
                                                    class="grid grid-cols-6 gap-6"
                                                >
                                                    <div
                                                        class="col-span-6 sm:col-span-6"
                                                    >
                                                        <label
                                                            for="prod_name"
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Product Name
                                                        </label>
                                                        <input
                                                            type="number"
                                                            name="prod_name"
                                                            id="prod_name"
                                                            required
                                                            autocomplete="prod_name"
                                                            v-model="form.or_id"
                                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="pt-8 text-right">
                                                    <button
                                                        type="submit"
                                                        class="inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
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
                                        Supplier
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Personnel
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Product
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Quantity
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Order Date
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Status
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr v-for="order in orders" :key="order.or_id">
                                    <td
                                        class="max-w-xs whitespace-nowrap px-6 py-4"
                                    >
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ order.company }}
                                        </div>
                                        <div
                                            class="truncate text-sm text-gray-500"
                                        >
                                            {{ order.address }}
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
                                                    {{ order.username }}
                                                </div>
                                                <div
                                                    class="text-sm text-gray-500"
                                                >
                                                    {{ order.role }}
                                                </div>
                                            </div>
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
                                                    {{ order.prod_name }}
                                                </div>
                                                <div
                                                    class="text-sm text-gray-500"
                                                >
                                                    {{ order.unit }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ order.quantity }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ order.order_date }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            <span
                                                v-if="
                                                    order.status == 'Received'
                                                "
                                                class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800"
                                            >
                                                {{ order.status }}
                                            </span>
                                            <span
                                                v-else-if="
                                                    order.status == 'Pending'
                                                "
                                                class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800"
                                            >
                                                {{ order.status }}
                                            </span>
                                            <span
                                                v-else-if="
                                                    order.status == 'Cancelled'
                                                "
                                                class="inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800"
                                            >
                                                {{ order.status }}
                                            </span>
                                        </div>
                                    </td>
                                    <td
                                        class="flex flex-row space-x-2 whitespace-nowrap px-6 py-4 text-right text-sm font-medium"
                                    >
                                        <Link
                                            href="#"
                                            class="text-primary/80 hover:text-primary"
                                        >
                                            Edit
                                        </Link>
                                        <form>
                                            <button
                                                type="submit"
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
