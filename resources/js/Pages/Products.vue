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
import { ref } from "vue";

const props = defineProps({
    products: Object,
    message: String,
});

const isOpen = ref(false);
const isEditModalOpen = ref(false);
const selectedProduct = ref(props.products[0]);

function closeEditModal() {
    isEditModalOpen.value = false;
}

function openEditModal(product) {
    selectedProduct.value = product;
    isEditModalOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}

function openModal() {
    isOpen.value = true;
}

const form = useForm({
    prod_name: "",
    shelf_life: 0,
    unit: "piece",
    appreciation: 0,
    max_lvl: 0,
});

const editForm = useForm({
    prod_name: selectedProduct.value.prod_name,
    shelf_life: selectedProduct.value.shelf_life,
    unit: selectedProduct.value.unit,
    appreciation: selectedProduct.value.appreciation,
    max_lvl: selectedProduct.value.max_lvl,
});

const deleteForm = useForm({
    product_id: "",
});

const submit = () => {
    form.post(route("products.store"), {
        onFinish: () => {
            form.reset("name", "price", "description");
            closeModal();
        },
    });
};

const updateProduct = () => {
    editForm.patch(route("products.update", selectedProduct.value.prod_id));
    closeEditModal();
};

const deleteProduct = (prod_id) => {
    if (confirm("Are you sure you want to delete this product?")) {
        deleteForm.delete(route("products.destroy", prod_id));
    }
};
</script>
<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <template v-slot:header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0">
                    <h1 class="text-3xl font-bold text-white">Products</h1>
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
                                                Product Information
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
                                                                for="prod_name"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Product Name
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.prod_name
                                                                    "
                                                                    type="text"
                                                                    name="prod_name"
                                                                    required
                                                                    id="prod_name"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                                        >
                                                            <label
                                                                for="shelf_life"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Shelf Life (days
                                                                before expiry)
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.shelf_life
                                                                    "
                                                                    type="number"
                                                                    name="shelf_life"
                                                                    required
                                                                    id="shelf_life"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                                        >
                                                            <label
                                                                for="unit"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Unit
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <select
                                                                    id="unit"
                                                                    name="unit"
                                                                    required
                                                                    v-model="
                                                                        form.unit
                                                                    "
                                                                    autocomplete="unit"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                >
                                                                    <option
                                                                        value="piece"
                                                                    >
                                                                        Piece
                                                                    </option>
                                                                    <option
                                                                        value="pack"
                                                                    >
                                                                        Pack
                                                                    </option>
                                                                    <option
                                                                        value="bottle"
                                                                    >
                                                                        Bottle
                                                                    </option>
                                                                    <option
                                                                        value="bag"
                                                                    >
                                                                        Bag
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                                        >
                                                            <label
                                                                for="appreciation"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Appreciation in
                                                                percent
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.appreciation
                                                                    "
                                                                    type="number"
                                                                    name="appreciation"
                                                                    required
                                                                    id="appreciation"
                                                                    step="0.01"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                                        >
                                                            <label
                                                                for="max_lvl"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Maximum Level
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.max_lvl
                                                                    "
                                                                    type="number"
                                                                    name="max_lvl"
                                                                    required
                                                                    id="max_lvl"
                                                                    step="0.01"
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

        <!--  -->
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
                                        Product Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Shelf Life
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Unit
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Appreciation
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Critical Level
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr
                                    v-for="product in products"
                                    :key="product.prod_id"
                                >
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.prod_name }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.shelf_life }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.unit }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.appreciation }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ product.max_lvl }}
                                        </div>
                                    </td>
                                    <td
                                        class="flex flex-row space-x-2 whitespace-nowrap px-6 py-4 text-right text-sm font-medium"
                                    >
                                        <button
                                            type="button"
                                            @click="openEditModal(product)"
                                            class="text-primary/80 hover:text-primary"
                                        >
                                            Edit
                                        </button>
                                        <form
                                            @submit.prevent="
                                                deleteProduct(product.prod_id)
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
                                class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg font-medium leading-6 text-gray-900"
                                >
                                    Update Product Information
                                    <p
                                        class="mt-1 max-w-2xl text-sm text-gray-500"
                                    >
                                        Please fill out the information below.
                                    </p>
                                </DialogTitle>

                                <form
                                    @submit.prevent="updateProduct"
                                    class="mt-8"
                                >
                                    <div class="space-y-6 sm:space-y-5">
                                        <div class="space-y-6 sm:space-y-5">
                                            <div
                                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                            >
                                                <label
                                                    for="prod_name"
                                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                >
                                                    Product Name
                                                </label>
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <input
                                                        v-model="
                                                            editForm.prod_name
                                                        "
                                                        type="text"
                                                        name="prod_name"
                                                        required
                                                        id="prod_name"
                                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                    />
                                                </div>
                                            </div>

                                            <div
                                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                            >
                                                <label
                                                    for="shelf_life"
                                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                >
                                                    Shelf Life (days before
                                                    expiry)
                                                </label>
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <input
                                                        v-model="
                                                            editForm.shelf_life
                                                        "
                                                        type="number"
                                                        name="shelf_life"
                                                        required
                                                        id="shelf_life"
                                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                    />
                                                </div>
                                            </div>

                                            <div
                                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                            >
                                                <label
                                                    for="unit"
                                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                >
                                                    Unit
                                                </label>
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <select
                                                        id="unit"
                                                        name="unit"
                                                        required
                                                        v-model="editForm.unit"
                                                        autocomplete="unit"
                                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                    >
                                                        <option value="piece">
                                                            Piece
                                                        </option>
                                                        <option value="pack">
                                                            Pack
                                                        </option>
                                                        <option value="bottle">
                                                            Bottle
                                                        </option>
                                                        <option value="bag">
                                                            Bag
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div
                                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                            >
                                                <label
                                                    for="appreciation"
                                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                >
                                                    Appreciation in percent
                                                </label>
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <input
                                                        v-model="
                                                            editForm.appreciation
                                                        "
                                                        type="number"
                                                        name="appreciation"
                                                        required
                                                        id="appreciation"
                                                        step="0.01"
                                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:text-sm"
                                                    />
                                                </div>
                                            </div>

                                            <div
                                                class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                            >
                                                <label
                                                    for="max_lvl"
                                                    class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                >
                                                    Maximum Level
                                                </label>
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <input
                                                        v-model="
                                                            editForm.max_lvl
                                                        "
                                                        type="number"
                                                        name="max_lvl"
                                                        required
                                                        id="max_lvl"
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
