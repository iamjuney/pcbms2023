<script setup>
import CashierLayout from "@/Layouts/CashierLayout.vue";
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
    customers: Object,
    consignedProducts: Object,
    message: String,
});

const isOpen = ref(false);
const selectedProduct = ref(props.consignedProducts[0]);
const quantity = ref(1);
const products = ref([]);

function closeModal() {
    isOpen.value = false;
}

function openModal() {
    isOpen.value = true;
    customerForm.reset();
}

const activeStep = ref(0);

const steps = ref([
    {
        id: 1,
        name: "Customer Details",
        description: "Enter the necessary information about the customer.",
        href: "#",
        status: "current",
    },
    {
        id: 2,
        name: "Purchased Items",
        description: "Review the items that the customer has purchased.",
        href: "#",
        status: "upcoming",
    },
]);

function nextStep() {
    const currentStep = steps.value.find((step) => step.status === "current");
    const nextStep = steps.value.find((step) => step.id === currentStep.id + 1);

    currentStep.status = "complete";
    nextStep.status = "current";

    activeStep.value = 1;
}

function backStep() {
    const currentStep = steps.value.find((step) => step.status === "current");
    const prevStep = steps.value.find((step) => step.id === currentStep.id - 1);

    currentStep.status = "upcoming";
    prevStep.status = "current";

    activeStep.value = 0;
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
    date_issued: getToday(),
    cust_id: props.customers[0].cust_id,
    products: products.value,
});

const customerForm = useForm({
    name: "",
    address: "",
});

const submit = () => {
    form.products = products.value;
    form.post(route("sales.store"));
    form.reset();
    backStep();
    products.value = [];
};

const submitNewCustomer = () => {
    customerForm.post(route("customers.store"));

    closeModal();
};

const imageSrc =
    "https://th.bing.com/th/id/OIP.1DxZe215nAGPIlQ1LgxQoQAAAA?pid=ImgDet&rs=1";
const imageAlt =
    "Empty bag with white canvas, black canvas straps, and a black zipper pull.";

function addProduct() {
    const product = {
        product: selectedProduct.value,
        qty_sold: quantity.value,
    };

    const existingProduct = products.value.find((p) => {
        return p.product.item_id === product.product.item_id;
    });

    if (existingProduct) {
        existingProduct.qty_sold += product.qty_sold;

        //update product in products with new qty
        products.value = products.value.map((p) => {
            if (p.item_id === existingProduct.product.item_id) {
                p.qty_sold = existingProduct.qty_sold;
            }

            return p;
        });
    } else products.value.push(product);
}

function removeProduct(item_id) {
    products.value = products.value.filter((product) => {
        return product.product.item_id !== item_id;
    });
}

function getTotal() {
    return products.value.reduce((total, product) => {
        return total + product.qty_sold * product.product.selling_price;
    }, 0);
}
</script>

<template>
    <Head title="Invoice" />

    <CashierLayout>
        <template v-slot:header>
            <h1 class="text-3xl font-bold text-white">Create Invoice</h1>
        </template>

        <div class="rounded-lg border bg-white py-4 text-gray-700 shadow-sm">
            <div class="lg:border-b lg:border-t lg:border-gray-200">
                <nav
                    class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"
                    aria-label="Progress"
                >
                    <ol
                        role="list"
                        class="overflow-hidden rounded-md lg:flex lg:rounded-none lg:border-l lg:border-r lg:border-gray-200"
                    >
                        <li
                            v-for="(step, stepIdx) in steps"
                            :key="step.id"
                            class="relative overflow-hidden lg:flex-1"
                        >
                            <div
                                :class="[
                                    stepIdx === 0
                                        ? 'rounded-t-md border-b-0'
                                        : '',
                                    stepIdx === steps.length - 1
                                        ? 'rounded-b-md border-t-0'
                                        : '',
                                    'overflow-hidden border border-gray-200 lg:border-0',
                                ]"
                            >
                                <a
                                    v-if="step.status === 'complete'"
                                    :href="step.href"
                                    class="group"
                                >
                                    <span
                                        class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full"
                                        aria-hidden="true"
                                    />
                                    <span
                                        :class="[
                                            stepIdx !== 0 ? 'lg:pl-9' : '',
                                            'flex items-start px-6 py-5 text-sm font-medium',
                                        ]"
                                    >
                                        <span class="flex-shrink-0">
                                            <span
                                                class="flex h-10 w-10 items-center justify-center rounded-full bg-primary"
                                            >
                                                <Icon
                                                    icon="fluent:checkmark-24-regular"
                                                    class="h-6 w-6 text-white"
                                                />
                                            </span>
                                        </span>
                                        <span
                                            class="ml-4 mt-0.5 flex min-w-0 flex-col"
                                        >
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide"
                                                >{{ step.name }}</span
                                            >
                                            <span
                                                class="text-sm font-medium text-gray-500"
                                                >{{ step.description }}</span
                                            >
                                        </span>
                                    </span>
                                </a>
                                <a
                                    v-else-if="step.status === 'current'"
                                    :href="step.href"
                                    aria-current="step"
                                >
                                    <span
                                        class="absolute left-0 top-0 h-full w-1 bg-primary lg:bottom-0 lg:top-auto lg:h-1 lg:w-full"
                                        aria-hidden="true"
                                    />
                                    <span
                                        :class="[
                                            stepIdx !== 0 ? 'lg:pl-9' : '',
                                            'flex items-start px-6 py-5 text-sm font-medium',
                                        ]"
                                    >
                                        <span class="flex-shrink-0">
                                            <span
                                                class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-primary"
                                            >
                                                <span class="text-primary"
                                                    >0{{ step.id }}</span
                                                >
                                            </span>
                                        </span>
                                        <span
                                            class="ml-4 mt-0.5 flex min-w-0 flex-col"
                                        >
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-primary"
                                                >{{ step.name }}</span
                                            >
                                            <span
                                                class="text-sm font-medium text-gray-500"
                                                >{{ step.description }}</span
                                            >
                                        </span>
                                    </span>
                                </a>
                                <a v-else :href="step.href" class="group">
                                    <span
                                        class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full"
                                        aria-hidden="true"
                                    />
                                    <span
                                        :class="[
                                            stepIdx !== 0 ? 'lg:pl-9' : '',
                                            'flex items-start px-6 py-5 text-sm font-medium',
                                        ]"
                                    >
                                        <span class="flex-shrink-0">
                                            <span
                                                class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300"
                                            >
                                                <span class="text-gray-500">{{
                                                    step.id
                                                }}</span>
                                            </span>
                                        </span>
                                        <span
                                            class="ml-4 mt-0.5 flex min-w-0 flex-col"
                                        >
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-500"
                                                >{{ step.name }}</span
                                            >
                                            <span
                                                class="text-sm font-medium text-gray-500"
                                                >{{ step.description }}</span
                                            >
                                        </span>
                                    </span>
                                </a>
                                <template v-if="stepIdx !== 0">
                                    <!-- Separator -->
                                    <div
                                        class="absolute inset-0 left-0 top-0 hidden w-3 lg:block"
                                        aria-hidden="true"
                                    >
                                        <svg
                                            class="h-full w-full text-gray-300"
                                            viewBox="0 0 12 82"
                                            fill="none"
                                            preserveAspectRatio="none"
                                        >
                                            <path
                                                d="M0.5 0V31L10.5 41L0.5 51V82"
                                                stroke="currentcolor"
                                                vector-effect="non-scaling-stroke"
                                            />
                                        </svg>
                                    </div>
                                </template>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <div class="px-4 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
                <div
                    v-if="activeStep == 0"
                    class="grid grid-flow-row grid-cols-2"
                >
                    <div
                        class="pr-8 text-lg font-medium leading-6 text-gray-900"
                    >
                        Customer Details
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Please fill out the information below.
                        </p>

                        <div class="mt-6 space-y-6 sm:space-y-5">
                            <div class="space-y-6 sm:space-y-5">
                                <div
                                    class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <button
                                        @click="openModal"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:col-span-3"
                                    >
                                        New Customer
                                    </button>
                                    <div
                                        class="relative mt-1 sm:col-span-3 sm:mt-0"
                                    >
                                        <div
                                            class="absolute inset-0 flex items-center"
                                        >
                                            <div
                                                class="w-full border-t border-gray-300"
                                            />
                                        </div>
                                        <div
                                            class="relative flex justify-center text-sm"
                                        >
                                            <span
                                                class="bg-white px-2 text-gray-500"
                                            >
                                                Or select from
                                            </span>
                                        </div>
                                    </div>
                                    <label
                                        for="cust_id"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        Customer
                                    </label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <Listbox
                                            name="cust_id"
                                            as="div"
                                            class="col-span-6 sm:col-span-6"
                                            v-model="form.cust_id"
                                        >
                                            <div class="relative mt-1">
                                                <ListboxButton
                                                    class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm"
                                                >
                                                    <span
                                                        class="block truncate"
                                                        >{{
                                                            props.customers.find(
                                                                (customer) =>
                                                                    customer.cust_id ===
                                                                    form.cust_id
                                                            ).name
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
                                                            v-for="customer in props.customers"
                                                            :key="
                                                                customer.cust_id
                                                            "
                                                            :value="
                                                                customer.cust_id
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
                                                                        customer.name
                                                                    }}</span
                                                                >
                                                                <span
                                                                    :class="[
                                                                        selected
                                                                            ? 'text-primary/50'
                                                                            : 'text-gray-500',
                                                                        'block truncate',
                                                                    ]"
                                                                >
                                                                    {{
                                                                        customer.address
                                                                    }}
                                                                </span>
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
                                        for="date"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        Date
                                    </label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <input
                                            v-model="form.date_issued"
                                            type="date"
                                            name="date"
                                            required
                                            id="date"
                                            class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                        />
                                    </div>
                                </div>

                                <div
                                    class="mt-8 pt-8 text-right sm:border-t sm:border-gray-200"
                                >
                                    <button
                                        @click="nextStep"
                                        class="inline-flex justify-center rounded-md border border-transparent bg-primary px-8 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                    >
                                        Next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    v-if="activeStep == 1"
                    class="grid grid-flow-row grid-cols-2"
                >
                    <div
                        class="pr-8 text-lg font-medium leading-6 text-gray-900"
                    >
                        Purchased Items
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            Add items to the invoice
                        </p>
                        <div class="mt-6 space-y-6 sm:space-y-5">
                            <div class="space-y-6 sm:space-y-5">
                                <div
                                    class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                >
                                    <button
                                        class="inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:col-span-3"
                                    >
                                        Scan Barcode
                                    </button>
                                    <div
                                        class="relative mt-1 sm:col-span-3 sm:mt-0"
                                    >
                                        <div
                                            class="absolute inset-0 flex items-center"
                                        >
                                            <div
                                                class="w-full border-t border-gray-300"
                                            />
                                        </div>
                                        <div
                                            class="relative flex justify-center text-sm"
                                        >
                                            <span
                                                class="bg-white px-2 text-gray-500"
                                            >
                                                Or select from
                                            </span>
                                        </div>
                                    </div>
                                    <label
                                        for="cust_id"
                                        class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                    >
                                        Products
                                    </label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <Listbox
                                            name="cust_id"
                                            as="div"
                                            class="col-span-6 sm:col-span-6"
                                            v-model="selectedProduct"
                                        >
                                            <div class="relative mt-1">
                                                <ListboxButton
                                                    class="relative w-full cursor-default rounded-md border border-gray-300 bg-white py-2 pl-3 pr-10 text-left shadow-sm focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary sm:text-sm"
                                                >
                                                    <span
                                                        class="block truncate"
                                                        >{{
                                                            props.consignedProducts.find(
                                                                (product) =>
                                                                    product.item_id ===
                                                                    selectedProduct.item_id
                                                            ).product.prod_name
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
                                                            v-for="product in props.consignedProducts"
                                                            :key="
                                                                product.item_id
                                                            "
                                                            :value="product"
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
                                                                        product
                                                                            .product
                                                                            .prod_name
                                                                    }}</span
                                                                >
                                                                <span
                                                                    :class="[
                                                                        selected
                                                                            ? 'text-primary/50'
                                                                            : 'text-gray-500',
                                                                        'block truncate',
                                                                    ]"
                                                                >
                                                                    {{
                                                                        product.barcode
                                                                    }}
                                                                </span>
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
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <input
                                            v-model="quantity"
                                            type="number"
                                            name="quantity"
                                            required
                                            id="quantity"
                                            min="1"
                                            class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                        />
                                    </div>
                                </div>

                                <div
                                    class="mt-8 flex w-full flex-row justify-between pt-8 text-right sm:border-t sm:border-gray-200"
                                >
                                    <button
                                        @click="backStep"
                                        class="rounded-md border border-gray-300 bg-white px-8 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary/80 focus:ring-offset-2"
                                    >
                                        Back
                                    </button>
                                    <button
                                        @click="addProduct()"
                                        class="ml-2 inline-flex justify-center rounded-md border border-transparent bg-primary px-8 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                    >
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-lg font-medium leading-6 text-gray-900">
                        Invoice
                        <div
                            v-if="!products.length"
                            class="flex h-full w-full items-center justify-center text-center"
                        >
                            <div>
                                <Icon
                                    icon="fluent:box-24-regular"
                                    class="mx-auto h-12 w-12 text-gray-400"
                                />
                                <p class="mt-1 text-sm text-gray-500">
                                    No products added yet
                                </p>
                            </div>
                        </div>
                        <div v-if="products.length" class="w-full">
                            <div class="flex h-full flex-col">
                                <div class="flex-1 overflow-y-auto pb-6">
                                    <div class="mt-6">
                                        <div class="flow-root">
                                            <ul
                                                role="list"
                                                class="-my-6 divide-y divide-gray-200"
                                            >
                                                <li
                                                    v-for="product in products"
                                                    :key="product.id"
                                                    class="flex py-6"
                                                >
                                                    <div
                                                        class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200"
                                                    >
                                                        <img
                                                            :src="imageSrc"
                                                            :alt="imageAlt"
                                                            class="h-full w-full object-cover object-center"
                                                        />
                                                    </div>

                                                    <div
                                                        class="ml-4 flex flex-1 flex-col"
                                                    >
                                                        <div>
                                                            <div
                                                                class="flex justify-between text-base font-medium text-gray-900"
                                                            >
                                                                <h3>
                                                                    {{
                                                                        product
                                                                            .product
                                                                            .product
                                                                            .prod_name
                                                                    }}
                                                                </h3>
                                                                <p class="ml-4">
                                                                    ₱{{
                                                                        product
                                                                            .product
                                                                            .selling_price *
                                                                        product.qty_sold
                                                                    }}
                                                                </p>
                                                            </div>
                                                            <p
                                                                class="mt-1 text-sm text-gray-500"
                                                            >
                                                                {{
                                                                    product
                                                                        .product
                                                                        .barcode
                                                                }}
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="flex flex-1 items-end justify-between text-sm"
                                                        >
                                                            <p
                                                                class="text-gray-500"
                                                            >
                                                                Qty
                                                                {{
                                                                    product.qty_sold
                                                                }}
                                                            </p>

                                                            <div class="flex">
                                                                <button
                                                                    @click="
                                                                        removeProduct(
                                                                            product
                                                                                .product
                                                                                .item_id
                                                                        )
                                                                    "
                                                                    class="font-medium text-red-700 hover:text-indigo-500"
                                                                >
                                                                    Remove
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200 pt-6">
                                    <div
                                        class="flex justify-between text-base font-medium text-gray-900"
                                    >
                                        <p>Total</p>
                                        <p>₱{{ getTotal() }}</p>
                                    </div>
                                    <div class="mt-6">
                                        <form @submit.prevent="submit">
                                            <button
                                                type="submit"
                                                class="inline-flex w-full justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 sm:col-span-3"
                                            >
                                                Save
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-10">
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
                                    New Customer Information
                                    <p class="mt-1 text-sm text-gray-500">
                                        Please fill out the information below.
                                    </p>
                                </DialogTitle>

                                <div
                                    class="mt-8 flex w-full flex-row items-start justify-between pt-8 sm:border-t sm:border-gray-200"
                                >
                                    <div
                                        class="w-full space-y-6 pr-4 sm:space-y-5"
                                    >
                                        <div
                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4"
                                        >
                                            <label
                                                for="name"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                            >
                                                Name
                                            </label>
                                            <div
                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                            >
                                                <input
                                                    v-model="customerForm.name"
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
                                                for="address"
                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                            >
                                                Address
                                            </label>
                                            <div
                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                            >
                                                <textarea
                                                    v-model="
                                                        customerForm.address
                                                    "
                                                    id="address"
                                                    name="address"
                                                    rows="3"
                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-8 flex w-full flex-row items-end justify-end pt-8 text-right sm:border-t sm:border-gray-200"
                                >
                                    <button
                                        @click="closeModal"
                                        class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary/80 focus:ring-offset-2"
                                    >
                                        Cancel
                                    </button>
                                    <form @submit.prevent="submitNewCustomer">
                                        <button
                                            type="submit"
                                            class="ml-2 inline-flex justify-center rounded-md border border-transparent bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                                        >
                                            Save
                                        </button>
                                    </form>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </CashierLayout>
</template>
