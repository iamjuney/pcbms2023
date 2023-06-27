<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    Listbox,
    ListboxButton,
    ListboxOption,
    ListboxOptions,
    TransitionChild,
    TransitionRoot,
} from "@headlessui/vue";
import { Icon } from "@iconify/vue";
import { Head, useForm } from "@inertiajs/vue3";
import { defineProps, ref } from "vue";

const props = defineProps({
    orders: Object,
    suppliers: Object,
    products: Object,
    message: String,
});

const isOpen = ref(false);
const isEditModalOpen = ref(false);

const form = useForm({
    supp_id: props.orders[0].supp_id,
    userid: 1,
    status: "Pending",
    item_id: props.orders[0].item_id,
    quantity: 1,
});

const editForm = useForm({
    or_id: props.orders[0].or_id,
    supp_id: props.orders[0].supp_id,
    userid: props.orders[0].userid,
    status: props.orders[0].status,
    item_id: props.orders[0].item_id,
    quantity: props.orders[0].quantity,
});

function closeEditModal() {
    isEditModalOpen.value = false;
}

function openEditModal(order) {
    editForm.or_id = order.or_id;
    editForm.supp_id = order.supp_id;
    editForm.userid = order.userid;
    editForm.status = order.status;
    editForm.item_id = order.item_id;
    editForm.quantity = order.quantity;

    isEditModalOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}

function openModal() {
    isOpen.value = true;
}

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

const updateOrder = () => {
    editForm.patch(route("orders.update", editForm.or_id));
    closeEditModal();
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
                                                <p
                                                    class="mt-1 max-w-2xl text-sm text-gray-500"
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
                                                    class="space-y-6 sm:space-y-5"
                                                >
                                                    <div
                                                        class="space-y-6 sm:space-y-5"
                                                    >
                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                                        >
                                                            <label
                                                                for="supp_id"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Select Supplier
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <Listbox
                                                                    name="supp_id"
                                                                    as="div"
                                                                    class="col-span-6 sm:col-span-6"
                                                                    v-model="
                                                                        form.supp_id
                                                                    "
                                                                >
                                                                    <div
                                                                        class="relative mt-1"
                                                                    >
                                                                        <ListboxButton
                                                                            class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm"
                                                                        >
                                                                            <span
                                                                                class="block truncate"
                                                                                >{{
                                                                                    props.suppliers.find(
                                                                                        (
                                                                                            supplier
                                                                                        ) =>
                                                                                            supplier.supp_id ===
                                                                                            form.supp_id
                                                                                    )
                                                                                        .company
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
                                                                            leave-active-class="transition duration-100 ease-in"
                                                                            leave-from-class="opacity-100"
                                                                            leave-to-class="opacity-0"
                                                                        >
                                                                            <ListboxOptions
                                                                                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                                            >
                                                                                <ListboxOption
                                                                                    v-slot="{
                                                                                        active,
                                                                                        selected,
                                                                                    }"
                                                                                    v-for="supplier in props.suppliers"
                                                                                    :key="
                                                                                        supplier.supp_id
                                                                                    "
                                                                                    :value="
                                                                                        supplier.supp_id
                                                                                    "
                                                                                    as="template"
                                                                                >
                                                                                    <li
                                                                                        :class="[
                                                                                            active
                                                                                                ? 'bg-primary/10 text-primary'
                                                                                                : 'text-gray-900',
                                                                                            'relative cursor-default select-none py-2 pl-10 pr-4',
                                                                                        ]"
                                                                                    >
                                                                                        <span
                                                                                            :class="[
                                                                                                selected
                                                                                                    ? 'font-medium'
                                                                                                    : 'font-normal',
                                                                                                'block truncate',
                                                                                            ]"
                                                                                            >{{
                                                                                                supplier.company
                                                                                            }}</span
                                                                                        >
                                                                                        <span
                                                                                            v-if="
                                                                                                selected
                                                                                            "
                                                                                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-primary"
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
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                                        >
                                                            <label
                                                                for="supp_id"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Select Product
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <Listbox
                                                                    name="item_id"
                                                                    as="div"
                                                                    class="col-span-6 sm:col-span-6"
                                                                    v-model="
                                                                        form.item_id
                                                                    "
                                                                >
                                                                    <div
                                                                        class="relative mt-1"
                                                                    >
                                                                        <ListboxButton
                                                                            class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm"
                                                                        >
                                                                            <span
                                                                                class="block truncate"
                                                                                >{{
                                                                                    props.products.find(
                                                                                        (
                                                                                            product
                                                                                        ) =>
                                                                                            product.prod_id ===
                                                                                            form.item_id
                                                                                    )
                                                                                        .prod_name
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
                                                                            leave-active-class="transition duration-100 ease-in"
                                                                            leave-from-class="opacity-100"
                                                                            leave-to-class="opacity-0"
                                                                        >
                                                                            <ListboxOptions
                                                                                class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                                            >
                                                                                <ListboxOption
                                                                                    v-slot="{
                                                                                        active,
                                                                                        selected,
                                                                                    }"
                                                                                    v-for="product in props.products"
                                                                                    :key="
                                                                                        product.prod_id
                                                                                    "
                                                                                    :value="
                                                                                        product.prod_id
                                                                                    "
                                                                                    as="template"
                                                                                >
                                                                                    <li
                                                                                        :class="[
                                                                                            active
                                                                                                ? 'bg-primary/10 text-primary'
                                                                                                : 'text-gray-900',
                                                                                            'relative cursor-default select-none py-2 pl-10 pr-4',
                                                                                        ]"
                                                                                    >
                                                                                        <span
                                                                                            :class="[
                                                                                                selected
                                                                                                    ? 'font-medium'
                                                                                                    : 'font-normal',
                                                                                                'block truncate',
                                                                                            ]"
                                                                                            >{{
                                                                                                product.prod_name
                                                                                            }}</span
                                                                                        >
                                                                                        <span
                                                                                            v-if="
                                                                                                selected
                                                                                            "
                                                                                            class="absolute inset-y-0 left-0 flex items-center pl-3 text-primary"
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
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                                        >
                                                            <label
                                                                for="quantity"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Quantity
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.quantity
                                                                    "
                                                                    type="number"
                                                                    name="quantity"
                                                                    min="1"
                                                                    required
                                                                    id="quantity"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="mt-4 pt-8 text-right sm:border-t sm:border-gray-200"
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
                                        <button
                                            type="button"
                                            @click="openEditModal(order)"
                                            class="text-primary/80 hover:text-primary"
                                        >
                                            Edit
                                        </button>
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

        <TransitionRoot appear :show="isEditModalOpen" as="template">
            <Dialog as="div" @close="closeEditModal" class="relative z-10">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
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
                                    <p
                                        class="mt-1 max-w-2xl text-sm text-gray-500"
                                    >
                                        Please fill out the information below.
                                    </p>
                                </DialogTitle>

                                <form
                                    @submit.prevent="updateOrder"
                                    class="mt-8"
                                >
                                    <div class="space-y-6 sm:space-y-5">
                                        <div class="space-y-6 sm:space-y-5">
                                            <div
                                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                            >
                                                <label
                                                    for="supp_id"
                                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                >
                                                    Supplier
                                                </label>
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <Listbox
                                                        name="supp_id"
                                                        as="div"
                                                        class="col-span-6 sm:col-span-6"
                                                        v-model="
                                                            editForm.supp_id
                                                        "
                                                    >
                                                        <div
                                                            class="relative mt-1"
                                                        >
                                                            <ListboxButton
                                                                class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm"
                                                            >
                                                                <span
                                                                    class="block truncate"
                                                                    >{{
                                                                        props.suppliers.find(
                                                                            (
                                                                                supplier
                                                                            ) =>
                                                                                supplier.supp_id ===
                                                                                editForm.supp_id
                                                                        )
                                                                            .company
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
                                                                leave-active-class="transition duration-100 ease-in"
                                                                leave-from-class="opacity-100"
                                                                leave-to-class="opacity-0"
                                                            >
                                                                <ListboxOptions
                                                                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                                >
                                                                    <ListboxOption
                                                                        v-slot="{
                                                                            active,
                                                                            selected,
                                                                        }"
                                                                        v-for="supplier in props.suppliers"
                                                                        :key="
                                                                            supplier.supp_id
                                                                        "
                                                                        :value="
                                                                            supplier.supp_id
                                                                        "
                                                                        as="template"
                                                                    >
                                                                        <li
                                                                            :class="[
                                                                                active
                                                                                    ? 'bg-primary/10 text-primary'
                                                                                    : 'text-gray-900',
                                                                                'relative cursor-default select-none py-2 pl-10 pr-4',
                                                                            ]"
                                                                        >
                                                                            <span
                                                                                :class="[
                                                                                    selected
                                                                                        ? 'font-medium'
                                                                                        : 'font-normal',
                                                                                    'block truncate',
                                                                                ]"
                                                                                >{{
                                                                                    supplier.company
                                                                                }}</span
                                                                            >
                                                                            <span
                                                                                v-if="
                                                                                    selected
                                                                                "
                                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-primary"
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
                                                </div>
                                            </div>

                                            <div
                                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                            >
                                                <label
                                                    for="supp_id"
                                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                >
                                                    Product
                                                </label>
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <Listbox
                                                        name="item_id"
                                                        as="div"
                                                        class="col-span-6 sm:col-span-6"
                                                        v-model="
                                                            editForm.item_id
                                                        "
                                                    >
                                                        <div
                                                            class="relative mt-1"
                                                        >
                                                            <ListboxButton
                                                                class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm"
                                                            >
                                                                <span
                                                                    class="block truncate"
                                                                    >{{
                                                                        props.products.find(
                                                                            (
                                                                                product
                                                                            ) =>
                                                                                product.prod_id ===
                                                                                editForm.item_id
                                                                        )
                                                                            .prod_name
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
                                                                leave-active-class="transition duration-100 ease-in"
                                                                leave-from-class="opacity-100"
                                                                leave-to-class="opacity-0"
                                                            >
                                                                <ListboxOptions
                                                                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                                                                >
                                                                    <ListboxOption
                                                                        v-slot="{
                                                                            active,
                                                                            selected,
                                                                        }"
                                                                        v-for="product in props.products"
                                                                        :key="
                                                                            product.prod_id
                                                                        "
                                                                        :value="
                                                                            product.prod_id
                                                                        "
                                                                        as="template"
                                                                    >
                                                                        <li
                                                                            :class="[
                                                                                active
                                                                                    ? 'bg-primary/10 text-primary'
                                                                                    : 'text-gray-900',
                                                                                'relative cursor-default select-none py-2 pl-10 pr-4',
                                                                            ]"
                                                                        >
                                                                            <span
                                                                                :class="[
                                                                                    selected
                                                                                        ? 'font-medium'
                                                                                        : 'font-normal',
                                                                                    'block truncate',
                                                                                ]"
                                                                                >{{
                                                                                    product.prod_name
                                                                                }}</span
                                                                            >
                                                                            <span
                                                                                v-if="
                                                                                    selected
                                                                                "
                                                                                class="absolute inset-y-0 left-0 flex items-center pl-3 text-primary"
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
                                                </div>
                                            </div>

                                            <div
                                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                            >
                                                <label
                                                    for="quantity"
                                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                >
                                                    Quantity
                                                </label>
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <input
                                                        v-model="
                                                            editForm.quantity
                                                        "
                                                        type="number"
                                                        name="quantity"
                                                        min="1"
                                                        required
                                                        id="quantity"
                                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                    />
                                                </div>
                                            </div>

                                            <div
                                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                            >
                                                <label
                                                    for="status"
                                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                >
                                                    Status
                                                </label>
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <select
                                                        id="status"
                                                        name="status"
                                                        required
                                                        v-model="
                                                            editForm.status
                                                        "
                                                        autocomplete="status"
                                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                    >
                                                        <option value="Pending">
                                                            Pending
                                                        </option>
                                                        <option
                                                            value="Received"
                                                        >
                                                            Received
                                                        </option>
                                                        <option
                                                            value="Cancelled"
                                                        >
                                                            Cancelled
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-4 pt-8 text-right sm:border-t sm:border-gray-200"
                                    >
                                        <button
                                            type="button"
                                            @click="closeEditModal"
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
    </AuthenticatedLayout>
</template>
