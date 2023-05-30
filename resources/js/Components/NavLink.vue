<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? "rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-700"
        : "rounded-md px-3 py-2 text-sm font-medium text-white hover:bg-white hover:bg-opacity-75 hover:text-gray-700"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
