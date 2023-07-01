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
    consignedProducts: Object,
    suppliers: Object,
    products: Object,
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

function openEditModal(product) {
    form.cp_id = product.cp_id;
    form.supp_id = product.supp_id;
    form.userid = product.userid;
    form.date_received = product.consigned_product.date_received;
    form.prod_id = product.prod_id;
    form.barcode = product.barcode;
    form.particulars = product.particulars;
    form.expiry_date = product.expiry_date;
    form.unit_price = product.unit_price;
    form.selling_price = product.selling_price;
    form.quantity = product.quantity;
    form.amount = product.amount;

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

const form = useForm({
    cp_id: "",
    supp_id: props.suppliers[0].supp_id,
    userid: 1,
    date_received: getToday(),
    prod_id: props.products[0].prod_id,
    barcode: "",
    particulars: "",
    expiry_date: getToday(),
    unit_price: 1,
    selling_price: 1,
    quantity: 1,
    amount: 1,
});

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
                    <h1 class="text-3xl font-bold text-white">
                        Consigned Inventory
                    </h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <button
                        type="button"
                        @click="openModal"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                    >
                        <div class="flex flex-row space-x-2 text-primary">
                            <span>Add New Consigned Product</span>
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
                                                Consigned Product Information
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
                                                    class="flex w-full flex-row items-start justify-between pt-8 sm:border-t sm:border-gray-200"
                                                >
                                                    <div
                                                        class="w-full space-y-6 pr-4 sm:space-y-5"
                                                    >
                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
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
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
                                                        >
                                                            <label
                                                                for="date_received"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Date
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.date_received
                                                                    "
                                                                    type="date"
                                                                    name="date_received"
                                                                    required
                                                                    id="date_received"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
                                                        >
                                                            <label
                                                                for="prod_id"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Product
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <Listbox
                                                                    name="prod_id"
                                                                    as="div"
                                                                    class="col-span-6 sm:col-span-6"
                                                                    v-model="
                                                                        form.prod_id
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
                                                                                            form.prod_id
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
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
                                                        >
                                                            <label
                                                                for="barcode"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Barcode
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.barcode
                                                                    "
                                                                    type="text"
                                                                    name="barcode"
                                                                    required
                                                                    id="barcode"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
                                                        >
                                                            <label
                                                                for="particulars"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Particulars
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <textarea
                                                                    v-model="
                                                                        form.particulars
                                                                    "
                                                                    id="particulars"
                                                                    name="particulars"
                                                                    rows="3"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                ></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="w-full space-y-6 pl-4 sm:space-y-5"
                                                    >
                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
                                                        >
                                                            <label
                                                                for="expiry_date"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Expiry Date
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.expiry_date
                                                                    "
                                                                    type="date"
                                                                    name="expiry_date"
                                                                    id="expiry_date"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
                                                        >
                                                            <label
                                                                for="unit_price"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Unit Price
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.unit_price
                                                                    "
                                                                    type="number"
                                                                    name="unit_price"
                                                                    min="1"
                                                                    step="0.01"
                                                                    id="unit_price"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
                                                        >
                                                            <label
                                                                for="selling_price"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Selling Price
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.selling_price
                                                                    "
                                                                    type="number"
                                                                    name="selling_price"
                                                                    min="1"
                                                                    step="0.01"
                                                                    id="selling_price"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
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
                                                                    id="quantity"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
                                                        >
                                                            <label
                                                                for="amount"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Amount
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.amount
                                                                    "
                                                                    type="number"
                                                                    name="amount"
                                                                    id="amount"
                                                                    min="1"
                                                                    step="0.01"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                        Barcode
                                    </th>
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
                                        Product Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Expiry Date
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Selling Price
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
                                        Amount
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr
                                    v-for="product in consignedProducts"
                                    :key="product.prod_id"
                                >
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.barcode }}
                                        </div>
                                    </td>
                                    <td
                                        class="max-w-[16rem] whitespace-nowrap px-6 py-4"
                                    >
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.company }}
                                        </div>
                                        <div
                                            class="truncate text-sm text-gray-500"
                                        >
                                            {{ product.address }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex flex-col items-start">
                                            <div
                                                class="text-sm font-medium text-gray-900"
                                            >
                                                {{ product.prod_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ product.unit }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.expiry_date }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.selling_price }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.quantity }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.amount }}
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
