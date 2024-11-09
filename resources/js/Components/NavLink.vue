<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import { BeakerIcon } from '@heroicons/vue/24/outline'
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
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out',


);
</script>

<template>
    <Link :href="href" :class="[
        
        active?'text-blue-600   bg-gray-100   ':'text-gray-900  ',
        'flex gap-2  items-center p-2  rounded-md  dark-:hover:bg-gray-700 group']">
                    

        <slot />
    </Link>
</template>
