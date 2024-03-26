<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center bg-gray-900 rounded-l-lg py-2 border-l-4 border-y-2 border-yellow-500 dark:border-yellow-500 border-right text-sm font-medium leading-5 text-black dark:text-yellow-400 focus:outline-none transition duration-150 ease-in-out'
        : 'inline-flex items-center py-2 border-l-4 border-y-2 border-transparent text-sm font-medium leading-5 text-black dark:text-white hover:text-yellow-500 focus:outline-none transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<style scoped>
.border-right{
    box-shadow: 1px 0 0 0 rgb(15, 23, 42) !important;
}
</style>
