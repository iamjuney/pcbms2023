<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    login: "",
    password: "",
    role: "personnel",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Login" />

    <GuestLayout>
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" @submit.prevent="submit">
                    <div>
                        <label
                            for="login"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Email / Username
                        </label>
                        <div class="mt-1">
                            <input
                                id="login"
                                name="login"
                                type="text"
                                v-model="form.login"
                                required
                                autofocus
                                autocomplete="username"
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary focus:outline-none focus:ring-primary sm:text-sm"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.login"
                            />
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label
                            for="password"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Password
                        </label>
                        <div class="mt-1">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary focus:outline-none focus:ring-primary sm:text-sm"
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.password"
                            />
                        </div>
                    </div>

                    <div>
                        <label
                            for="role"
                            class="block text-sm font-medium text-gray-700"
                            >Role</label
                        >
                        <select
                            id="role"
                            name="role"
                            v-model="form.role"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-primary focus:outline-none focus:ring-primary sm:text-sm"
                        >
                            <option value="personnel">Personnel</option>
                            <option value="cashier">Cashier</option>
                            <option selected value="manager">Manager</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <Checkbox
                                name="remember"
                                v-model:checked="form.remember"
                            />
                            <span class="ml-2 text-sm text-gray-600"
                                >Remember me</span
                            >
                        </div>

                        <div class="text-sm">
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="font-medium text-primary underline hover:text-primary/70"
                            >
                                Forgot your password?
                            </Link>
                        </div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-primary px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary/80 focus:ring-4 focus:ring-primary/30"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Login
                        </button>
                    </div>
                </form>

                <hr class="my-6 border-gray-400 sm:mx-auto lg:my-8" />

                <div
                    class="flex items-center text-sm font-medium text-gray-700"
                >
                    <span>Don't have an account?</span>
                    <Link
                        :href="route('register')"
                        class="pl-1 font-medium text-primary underline hover:text-primary/80"
                    >
                        Register Here
                    </Link>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
