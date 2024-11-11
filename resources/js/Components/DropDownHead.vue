<template>
    <div class="top-16 text-right">
        <Menu as="div" class="relative inline-block text-left">
            <div>
                <MenuButton
                    :class="borderless ? 'border-0' : 'border'"
                    class="inline-flex w-full justify-center rounded-md bg-white/20 px-4 py-2 text-sm font-medium text-blue-600 hover:bg-white/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-black/75"
                >
                    {{ title }}
                    <ChevronDownIcon
                        class="-mr-1 ml-2 h-5 w-5 text-blue-200 hover:text-blue-100"
                        aria-hidden="true"
                    />
                </MenuButton>
            </div>

            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <MenuItems
                    class="absolute z-20 right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                >
                    <div
                        class="px-1 py-1"
                        v-for="link in links"
                        :key="links.label"
                    >
                        <MenuItem v-slot="{ active }">
                            <Link
                                v-if="link.method"
                                :method="link.method"
                                :href="link.routeName"
                                :class="[
                                    active
                                        ? 'bg-blue-500 text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                            >
                                <svg
                                    :active="active"
                                    viewBox="0 0 24 24"
                                    :width="'24'"
                                    :height="'24'"
                                    class="text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white me-1.5"
                                >
                                    <path fill="currentColor" :d="link.path" />
                                </svg>
                                {{ link.label }}
                            </Link>

                            <a
                                v-else
                                :method="link.method"
                                :href="link.routeName"
                                :class="[
                                    active
                                        ? 'bg-blue-500 text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                            >
                                <svg
                                    :active="active"
                                    viewBox="0 0 24 24"
                                    :width="'24'"
                                    :height="'24'"
                                    class="text-gray-400 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white me-1.5"
                                >
                                    <path fill="currentColor" :d="link.path" />
                                </svg>
                                {{ link.label }}
                            </a>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>

<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    title: String,
    links: Object,
    borderless: Boolean,
});
</script>
