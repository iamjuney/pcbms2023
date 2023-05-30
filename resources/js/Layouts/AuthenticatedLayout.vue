<script setup>
import NavLink from "@/Components/NavLink.vue";
import { Icon } from "@iconify/vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const showingUserDropdown = ref(false);
</script>

<template>
    <div class="min-h-screen">
        <div class="bg-primary pb-16">
            <nav
                class="border-b border-indigo-300 border-opacity-25 bg-primary lg:border-none"
            >
                <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
                    <div
                        class="relative flex h-16 items-center justify-between lg:border-b lg:border-indigo-400 lg:border-opacity-25"
                    >
                        <div class="flex items-center px-2 lg:px-0">
                            <div class="flex-shrink-0">
                                <img
                                    class="block h-8"
                                    src="images/vsulogo.ico"
                                    alt="VSU Logo"
                                />
                            </div>
                            <div class="hidden lg:ml-10 lg:block">
                                <div class="flex space-x-4">
                                    <!-- Current: "bg-primary text-white", Default: "text-white hover:bg-indigo-500 hover:bg-opacity-75" -->
                                    <NavLink
                                        :href="route('dashboard')"
                                        :active="route().current('dashboard')"
                                    >
                                        Dashboard
                                    </NavLink>

                                    <NavLink
                                        :href="route('orders')"
                                        :active="route().current('orders')"
                                    >
                                        Orders
                                    </NavLink>

                                    <NavLink
                                        :href="route('suppliers')"
                                        :active="route().current('suppliers')"
                                    >
                                        Suppliers
                                    </NavLink>

                                    <NavLink
                                        :href="route('products')"
                                        :active="route().current('products')"
                                    >
                                        Products
                                    </NavLink>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-1 justify-center px-2 lg:ml-6 lg:justify-end"
                        >
                            <div class="w-full max-w-lg lg:max-w-xs">
                                <label for="search" class="sr-only"
                                    >Search</label
                                >
                                <div
                                    class="relative text-gray-400 focus-within:text-primary"
                                >
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                                    >
                                        <Icon
                                            icon="fluent:search-24-regular"
                                            class="text-600 h-5 w-5"
                                        />
                                    </div>
                                    <input
                                        id="search"
                                        class="block w-full rounded-md border border-transparent bg-white py-2 pl-10 pr-3 leading-5 text-gray-900 placeholder-gray-500 focus:border-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary sm:text-sm"
                                        placeholder="Search"
                                        type="search"
                                        name="search"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="flex lg:hidden">
                            <!-- Mobile menu button -->
                            <button
                                type="button"
                                class="inline-flex items-center justify-center rounded-md bg-white p-2 text-indigo-200 hover:bg-indigo-500 hover:bg-opacity-75 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-white"
                                aria-controls="mobile-menu"
                                aria-expanded="false"
                            >
                                <span class="sr-only">Open main menu</span>
                                <!--
                Heroicon name: outline/menu

                Menu open: "hidden", Menu closed: "block"
              -->
                                <svg
                                    class="block h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                </svg>
                                <!--
                Heroicon name: outline/x

                Menu open: "block", Menu closed: "hidden"
              -->
                                <svg
                                    class="hidden h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                        <div class="hidden lg:ml-4 lg:block">
                            <div class="flex items-center">
                                <button
                                    type="button"
                                    class="flex-shrink-0 rounded-full bg-white p-1 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary"
                                >
                                    <span class="sr-only"
                                        >View notifications</span
                                    >
                                    <Icon
                                        icon="fluent:alert-24-regular"
                                        class="h-6 w-6 text-primary/70 hover:text-primary"
                                    />
                                </button>

                                <!-- Profile dropdown -->
                                <div class="relative ml-3 flex-shrink-0">
                                    <div>
                                        <button
                                            @click="
                                                showingUserDropdown =
                                                    !showingUserDropdown
                                            "
                                            type="button"
                                            class="flex rounded-full bg-white text-sm text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-primary"
                                            id="user-menu-button"
                                            aria-expanded="false"
                                            aria-haspopup="true"
                                        >
                                            <span class="sr-only"
                                                >Open user menu</span
                                            >
                                            <img
                                                class="h-8 w-8 rounded-full"
                                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                alt=""
                                            />
                                        </button>
                                    </div>
                                    <div
                                        :class="{
                                            hidden: !showingUserDropdown,
                                        }"
                                        class="absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                        role="menu"
                                        aria-orientation="vertical"
                                        aria-labelledby="user-menu-button"
                                        tabindex="-1"
                                    >
                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                        <a
                                            href="#"
                                            class="block px-4 py-2 text-sm text-gray-700"
                                            role="menuitem"
                                            tabindex="-1"
                                            id="user-menu-item-0"
                                        >
                                            Your Profile
                                        </a>

                                        <a
                                            href="#"
                                            class="block px-4 py-2 text-sm text-gray-700"
                                            role="menuitem"
                                            tabindex="-1"
                                            id="user-menu-item-1"
                                        >
                                            Settings
                                        </a>

                                        <Link
                                            :href="route('logout')"
                                            method="post"
                                            class="block px-4 py-2 text-sm text-gray-700"
                                            role="menuitem"
                                            tabindex="-1"
                                            id="user-menu-item-2"
                                        >
                                            Sign out
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="lg:hidden" id="mobile-menu">
                    <div class="space-y-1 px-2 pb-3 pt-2">
                        <!-- Current: "bg-primary text-white", Default: "text-white hover:bg-indigo-500 hover:bg-opacity-75" -->
                        <a
                            href="#"
                            class="block rounded-md bg-primary px-3 py-2 text-base font-medium text-white"
                            aria-current="page"
                        >
                            Dashboard
                        </a>

                        <a
                            href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75"
                        >
                            Team
                        </a>

                        <a
                            href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75"
                        >
                            Projects
                        </a>

                        <a
                            href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75"
                        >
                            Calendar
                        </a>

                        <a
                            href="#"
                            class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75"
                        >
                            Reports
                        </a>
                    </div>
                    <div class="border-t border-primary pb-3 pt-4">
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img
                                    class="h-10 w-10 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt=""
                                />
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-white">
                                    Tom Cook
                                </div>
                                <div
                                    class="text-sm font-medium text-indigo-300"
                                >
                                    tom@example.com
                                </div>
                            </div>
                            <button
                                type="button"
                                class="ml-auto flex-shrink-0 rounded-full bg-white p-1 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-white"
                            >
                                <span class="sr-only">View notifications</span>
                                <!-- Heroicon name: outline/bell -->
                                <svg
                                    class="h-6 w-6"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                                    />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-3 space-y-1 px-2">
                            <a
                                href="#"
                                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75"
                            >
                                Your Profile
                            </a>

                            <a
                                href="#"
                                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75"
                            >
                                Settings
                            </a>

                            <Link
                                :href="route('logout')"
                                class="block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-indigo-500 hover:bg-opacity-75"
                            >
                                Sign out
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>
            <header class="py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>
        </div>

        <main class="-mt-16">
            <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                <!-- content -->
                <slot />
            </div>
        </main>
    </div>
</template>
