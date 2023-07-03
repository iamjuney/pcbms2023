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
    suppliers: Object,
    message: {
        type: String,
    },
});

const isOpen = ref(false);
const isEditModalOpen = ref(false);
const selectedSupplier = ref(props.suppliers[0]);

function closeEditModal() {
    isEditModalOpen.value = false;
}

function openEditModal(supplier) {
    selectedSupplier.value = supplier;

    editForm.supp_id = supplier.supp_id;
    editForm.company = supplier.company;
    editForm.contact_person = supplier.contact_person;
    editForm.sex = supplier.sex;
    editForm.address = supplier.address;
    editForm.phone = supplier.phone;

    isEditModalOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}
function openModal() {
    isOpen.value = true;
}

const form = useForm({
    company: "",
    contact_person: "",
    sex: "Male",
    address: "",
    phone: "",
});

const editForm = useForm({
    supp_id: selectedSupplier.value.supp_id,
    company: selectedSupplier.value.company,
    contact_person: selectedSupplier.value.contact_person,
    sex: selectedSupplier.value.sex,
    address: selectedSupplier.value.address,
    phone: selectedSupplier.value.phone,
});

const deleteForm = useForm({
    supp_id: "",
});

const submit = () => {
    form.post(route("suppliers.store"), {
        onFinish: () => {
            form.reset("company", "contact_person", "address", "phone");
            closeModal();
        },
    });
};

const updateSupplier = () => {
    editForm.patch(route("suppliers.update", selectedSupplier.value.supp_id));
    closeEditModal();
};

const deleteSupplier = (supp_id) => {
    if (confirm("Are you sure you want to delete this supplier?")) {
        deleteForm.delete(route("suppliers.destroy", supp_id));
    }
};
</script>
<template>
    <Head title="Suppliers" />

    <AuthenticatedLayout>
        <template v-slot:header>
            <div class="md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h1 class="text-3xl font-bold text-white">Suppliers</h1>
                </div>
                <div class="mt-4 flex md:ml-4 md:mt-0">
                    <button
                        type="button"
                        @click="openModal"
                        class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2"
                    >
                        <div class="flex flex-row space-x-2 text-primary">
                            <span>Add New Supplier</span
                            ><Icon
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
                                            class="w-full max-w-lg transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                        >
                                            <DialogTitle
                                                as="h3"
                                                class="text-lg font-medium leading-6 text-gray-900"
                                            >
                                                Supplier Information
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
                                                    class="space-y-8 divide-y divide-gray-200 sm:space-y-5"
                                                >
                                                    <div
                                                        class="space-y-6 sm:space-y-5"
                                                    >
                                                        <div
                                                            class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5"
                                                        >
                                                            <label
                                                                for="company"
                                                                class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"
                                                            >
                                                                Company
                                                            </label>
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.company
                                                                    "
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
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.contact_person
                                                                    "
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
                                                            <div
                                                                class="mt-1 sm:col-span-1 sm:mt-0"
                                                            >
                                                                <select
                                                                    v-model="
                                                                        form.sex
                                                                    "
                                                                    id="sex"
                                                                    name="sex"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:max-w-xs sm:text-sm"
                                                                >
                                                                    <option
                                                                        value="Male"
                                                                    >
                                                                        Male
                                                                    </option>
                                                                    <option
                                                                        value="Female"
                                                                    >
                                                                        Female
                                                                    </option>
                                                                    <option
                                                                        value="Non-binary"
                                                                    >
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
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.address
                                                                    "
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
                                                            <div
                                                                class="mt-1 sm:col-span-2 sm:mt-0"
                                                            >
                                                                <input
                                                                    v-model="
                                                                        form.phone
                                                                    "
                                                                    type="text"
                                                                    name="phone"
                                                                    id="phone"
                                                                    class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:max-w-xs sm:text-sm"
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
                                        Company
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                                    >
                                        Contact Person
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <tr
                                    v-for="supplier in suppliers"
                                    :key="supplier.supp_id"
                                >
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div
                                            class="text-md font-medium text-gray-900"
                                        >
                                            {{ supplier.company }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ supplier.address }}
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
                                                    {{
                                                        supplier.contact_person
                                                    }}
                                                </div>
                                                <div
                                                    class="text-sm text-gray-500"
                                                >
                                                    {{ supplier.sex }} |
                                                    {{ supplier.phone }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="flex flex-row space-x-2 whitespace-nowrap px-6 py-4 text-right text-sm font-medium"
                                    >
                                        <button
                                            type="button"
                                            @click="openEditModal(supplier)"
                                            class="text-primary/80 hover:text-primary"
                                        >
                                            Edit
                                        </button>
                                        <form
                                            @submit.prevent="
                                                deleteSupplier(supplier.supp_id)
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
                                class="w-full max-w-lg transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                            >
                                <DialogTitle
                                    as="h3"
                                    class="text-lg font-medium leading-6 text-gray-900"
                                >
                                    Update Supplier Information
                                    <p
                                        class="mt-1 max-w-2xl text-sm text-gray-500"
                                    >
                                        Please fill out the information below.
                                    </p>
                                </DialogTitle>

                                <form
                                    @submit.prevent="updateSupplier"
                                    class="mt-8"
                                >
                                    <div
                                        class="space-y-8 divide-y divide-gray-200 sm:space-y-5"
                                    >
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
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <input
                                                        v-model="
                                                            editForm.company
                                                        "
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
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <input
                                                        v-model="
                                                            editForm.contact_person
                                                        "
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
                                                <div
                                                    class="mt-1 sm:col-span-1 sm:mt-0"
                                                >
                                                    <select
                                                        v-model="editForm.sex"
                                                        id="sex"
                                                        name="sex"
                                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:max-w-xs sm:text-sm"
                                                    >
                                                        <option value="Male">
                                                            Male
                                                        </option>
                                                        <option value="Female">
                                                            Female
                                                        </option>
                                                        <option
                                                            value="Non-binary"
                                                        >
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
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <input
                                                        v-model="
                                                            editForm.address
                                                        "
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
                                                <div
                                                    class="mt-1 sm:col-span-2 sm:mt-0"
                                                >
                                                    <input
                                                        v-model="editForm.phone"
                                                        type="text"
                                                        name="phone"
                                                        id="phone"
                                                        class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-primary/80 focus:ring-primary/80 sm:max-w-xs sm:text-sm"
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
