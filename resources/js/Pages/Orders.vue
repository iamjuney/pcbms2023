<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { Icon } from "@iconify/vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { defineProps, ref } from "vue";

const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
}

function openModal() {
    isOpen.value = true;
}

const props = defineProps({
    orders: Object,
    suppliers: Object,
    products: Object,
    message: String,
});

const selectedSupplier = ref(props.suppliers[0]);
const selectedProduct = ref(props.products[0]);

const form = useForm({
    supp_id: selectedSupplier.value.supp_id,
    userid: 1,
    status: "Pending",
    item_id: selectedProduct.value.prod_id,
    quantity: 1,
});

const deleteForm = useForm({
    or_id: "",
});

const submit = () => {
    form.post(route("orders.store"), {
        onFinish: () => {
            form.reset("quantity");
            closeModal();
        },
    });
};

const deleteOrder = (or_id) => {
    if (confirm("Are you sure you want to delete this order?")) {
        deleteForm.delete(route("orders.destroy", or_id));
    }
};
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
                            <span>Add New Order</span>
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
                                            class="w-full max-w-md transform rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                        >
                                            <DialogTitle
                                                as="h3"
                                                class="text-lg font-medium leading-6 text-gray-900"
                                            >
                                                Order Information
                                            </DialogTitle>

                                            <form
                                                @submit.prevent="submit"
                                                class="mt-8"
                                            >
                                                <div
                                                    class="grid grid-cols-6 gap-6"
                                                >
                                                    <Listbox
                                                        as="div"
                                                        class="col-span-6 sm:col-span-6"
                                                        v-model="
                                                            selectedSupplier
                                                        "
                                                    >
                                                        <ListboxLabel
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Supplier
                                                        </ListboxLabel>
                                                        <div
                                                            class="relative mt-1"
                                                        >
                                                            <ListboxButton
                                                                class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                                            >
                                                                <span
                                                                    class="block truncate"
                                                                    >{{
                                                                        selectedSupplier.company
                                                                    }}</span
                                                                >
                                                                <span
                                                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                                                                >
                                                                    <Icon
                                                                        icon="fluent:chevron-up-down-24-regular"
                                                                        class="h-5 w-5 text-gray-400"
                                                                    />
                                                                </span>
                                                            </ListboxButton>

                                                            <transition
                                                                leave-active-class="transition ease-in duration-100"
                                                                leave-from-class="opacity-100"
                                                                leave-to-class="opacity-0"
                                                            >
                                                                <ListboxOptions
                                                                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                                >
                                                                    <ListboxOption
                                                                        as="template"
                                                                        v-for="supplier in suppliers"
                                                                        :key="
                                                                            supplier.supp_id
                                                                        "
                                                                        :value="
                                                                            supplier
                                                                        "
                                                                        v-slot="{
                                                                            active,
                                                                            selectedSupplier,
                                                                        }"
                                                                    >
                                                                        <li
                                                                            :class="[
                                                                                active
                                                                                    ? 'bg-indigo-600 text-white'
                                                                                    : 'text-gray-900',
                                                                                'relative cursor-default select-none py-2 pl-3 pr-9',
                                                                            ]"
                                                                        >
                                                                            <span
                                                                                :class="[
                                                                                    selectedSupplier
                                                                                        ? 'font-semibold'
                                                                                        : 'font-normal',
                                                                                    'block truncate',
                                                                                ]"
                                                                            >
                                                                                {{
                                                                                    supplier.company
                                                                                }}
                                                                            </span>

                                                                            <span
                                                                                v-if="
                                                                                    selectedSupplier
                                                                                "
                                                                                :class="[
                                                                                    active
                                                                                        ? 'text-white'
                                                                                        : 'text-indigo-600',
                                                                                    'absolute inset-y-0 right-0 flex items-center pr-4',
                                                                                ]"
                                                                            >
                                                                                <Icon
                                                                                    icon="fluent:checkmark-24-regular"
                                                                                    class="h-5 w-5"
                                                                                />
                                                                            </span>
                                                                        </li>
                                                                    </ListboxOption>
                                                                </ListboxOptions>
                                                            </transition>
                                                        </div>
                                                    </Listbox>

                                                    <Listbox
                                                        as="div"
                                                        class="col-span-6 sm:col-span-6"
                                                        v-model="
                                                            selectedProduct
                                                        "
                                                    >
                                                        <ListboxLabel
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Product
                                                        </ListboxLabel>
                                                        <div
                                                            class="relative mt-1"
                                                        >
                                                            <ListboxButton
                                                                class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm"
                                                            >
                                                                <span
                                                                    class="block truncate"
                                                                    >{{
                                                                        selectedProduct.prod_name
                                                                    }}</span
                                                                >
                                                                <span
                                                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
                                                                >
                                                                    <Icon
                                                                        icon="fluent:chevron-up-down-24-regular"
                                                                        class="h-5 w-5 text-gray-400"
                                                                    />
                                                                </span>
                                                            </ListboxButton>

                                                            <transition
                                                                leave-active-class="transition ease-in duration-100"
                                                                leave-from-class="opacity-100"
                                                                leave-to-class="opacity-0"
                                                            >
                                                                <ListboxOptions
                                                                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                                >
                                                                    <ListboxOption
                                                                        as="template"
                                                                        v-for="product in products"
                                                                        :key="
                                                                            product.prod_id
                                                                        "
                                                                        :value="
                                                                            product
                                                                        "
                                                                        v-slot="{
                                                                            active,
                                                                            selectedProduct,
                                                                        }"
                                                                    >
                                                                        <li
                                                                            :class="[
                                                                                active
                                                                                    ? 'bg-indigo-600 text-white'
                                                                                    : 'text-gray-900',
                                                                                'relative cursor-default select-none py-2 pl-3 pr-9',
                                                                            ]"
                                                                        >
                                                                            <span
                                                                                :class="[
                                                                                    selectedProduct
                                                                                        ? 'font-semibold'
                                                                                        : 'font-normal',
                                                                                    'block truncate',
                                                                                ]"
                                                                            >
                                                                                {{
                                                                                    product.prod_name
                                                                                }}
                                                                            </span>

                                                                            <span
                                                                                v-if="
                                                                                    selectedProduct
                                                                                "
                                                                                :class="[
                                                                                    active
                                                                                        ? 'text-white'
                                                                                        : 'text-indigo-600',
                                                                                    'absolute inset-y-0 right-0 flex items-center pr-4',
                                                                                ]"
                                                                            >
                                                                                <Icon
                                                                                    icon="fluent:checkmark-24-regular"
                                                                                    class="h-5 w-5"
                                                                                />
                                                                            </span>
                                                                        </li>
                                                                    </ListboxOption>
                                                                </ListboxOptions>
                                                            </transition>
                                                        </div>
                                                    </Listbox>

                                                    <div
                                                        class="col-span-6 sm:col-span-6"
                                                    >
                                                        <label
                                                            for="quantity"
                                                            class="block text-sm font-medium text-gray-700"
                                                        >
                                                            Quantity
                                                        </label>
                                                        <input
                                                            type="number"
                                                            name="quantity"
                                                            id="quantity"
                                                            required
                                                            autocomplete="quantity"
                                                            v-model="
                                                                form.quantity
                                                            "
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
                                        class="max-w-[16rem] whitespace-nowrap px-6 py-4"
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
                                        <div class="flex flex-col items-start">
                                            <div
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{ order.prod_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ order.unit }}
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
                                        <form
                                            @submit.prevent="
                                                deleteOrder(order.or_id)
                                            "
                                        >
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
