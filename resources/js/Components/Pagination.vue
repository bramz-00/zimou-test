<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
})
</script>

<template>
    <nav v-if="data.links.length > 3" role="navigation" aria-label="Pagination Navigation" class="px-2 flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            <span v-if="data.current_page <= 1" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                Précédent
            </span>
            <Link v-else :href="data.prev_page_url" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                Précédent
            </Link>

            <Link v-if="data.current_page < data.last_page" :href="data.next_page_url" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                Suivant
            </Link>
            <span v-else class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                Suivant
            </span>
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700  leading-5">
                    Showing
                    <span class="font-medium">{{ data.from }}</span>
                    to
                    <span class="font-medium">{{ data.to }}</span>
                    of
                    <span class="font-medium">{{ data.total }}</span>
                    entries
                </p>
            </div>

            <div>
                <span class="relative z-0 gap-2 flex shadow-sm rounded-md">
                    <span v-if="data.current_page <= 1" aria-disabled="true" aria-label="Previous">
                        <span class="relative inline-flex dark-:-:-::bg-slate-800 dark-:-:-::ring-blue-500 ring-blue-200 items-center px-2 py-2 text-sm font-medium text-gray-200 bg-white border dark-:-:-::border-slate-900 border-gray-300 cursor-default  leading-5" aria-hidden="true">
                          
                            <svg fill="currentColor" class="w-5 h-5" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M721.594 118.177c12.379 12.379 12.379 32.283 0 44.661l-349.647 349.647 349.647 349.647c12.379 12.379 12.379 32.283 0 44.661-5.705 5.735-13.603 9.284-22.331 9.284-8.726 0-16.625-3.549-22.33-9.283l-371.979-371.979c-5.735-5.705-9.284-13.603-9.284-22.331 0-8.726 3.549-16.625 9.283-22.33l371.979-371.979c12.379-12.379 32.404-12.379 44.661 0z" fill="" /></svg>
                        </span>
                    </span>
                    <Link v-else :href="data.prev_page_url" rel="prev" class="relative inline-flex dark-:-:-::hover:bg-slate-700 dark-:-:-::hover:bg-opacity-30  hover:bg-gray-100 hover:bg-opacity-70  dark-:-:-::bg-slate-900 dark-:-:-::ring-blue-500 ring-blue-200 items-center px-2 py-2 text-sm font-medium dark-:-:-::text-gray-300 text-gray-500 bg-white border dark-:-:-::border-slate-900 border-gray-300 leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-blue-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous">
                        <svg fill="currentColor" class="w-5 h-5" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M721.594 118.177c12.379 12.379 12.379 32.283 0 44.661l-349.647 349.647 349.647 349.647c12.379 12.379 12.379 32.283 0 44.661-5.705 5.735-13.603 9.284-22.331 9.284-8.726 0-16.625-3.549-22.33-9.283l-371.979-371.979c-5.735-5.705-9.284-13.603-9.284-22.331 0-8.726 3.549-16.625 9.283-22.33l371.979-371.979c12.379-12.379 32.404-12.379 44.661 0z" fill="" /></svg>

                    </Link>

                    <template v-for="(link, key) in data.links">
                        <template v-if="key > 0 && key < data.last_page + 1">
                            <span v-if="!link.active && link.url == null" :key="key" aria-disabled="true">
                                <span class="relative inline-flex dark-:-:-::bg-slate-900 dark-:-:-::ring-blue-500 ring-blue-200 items-center px-4 py-2 -ml-px text-sm font-medium dark-:-:-::text-gray-300 text-gray-700 bg-gray-100 border dark-:-:-::border-slate-900 border-gray-300 cursor-default leading-5">{{ link.label }}</span>
                            </span>

                            <span v-else-if="link.active" :key="`current-${key}`" aria-current="page">
                                <span class="relative inline-flex dark-:-:-::bg-slate-800 dark-:-:-::ring-blue-500 ring-blue-200 items-center px-4 py-2 -ml-px text-sm font-medium text-blue-500 bg-whiye border dark-:-:-::border-slate-900 border-blue-300 cursor-default leading-5">{{ link.label }}</span>
                            </span>

                            <Link v-else :key="`link-${key}`" :href="link.url" v-html="link.label" 
                            class="relative inline-flex dark-:-:-::hover:bg-slate-700 dark-:-:-::hover:bg-opacity-30  hover:bg-gray-100 hover:bg-opacity-70  dark-:-:-::bg-slate-900 dark-:-:-::ring-blue-500 ring-blue-200 items-center px-4 py-2 -ml-px text-sm font-medium dark-:-:-::text-white text-gray-700 bg-white border dark-:-:-::border-slate-900 border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring  focus:border-blue-300 active:bg-white active:text-gray-700 active:border-blue-600 transition ease-in-out duration-150" aria-label="`Go to page ${link.label}`" />
                        </template>
                    </template>

                   
                    <span  aria-disabled="true" >
                        <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium dark-:-:-::bg-slate-800 dark-:-:-::ring-blue-500 ring-blue-200 text-gray-200 bg-white border dark-:-:-::border-slate-900 border-gray-300 cursor-default leading-5" aria-hidden="true">
                            <svg  fill="currentColor" class="w-5 h-5"  viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M151.3472 107.7248L197.632 61.44l404.2752 404.2752 18.2272 18.2272 28.0576 28.0576-450.56 450.56-46.2848-46.2848L555.6224 512zM807.194624 962.67264v-901.12h65.536v901.12z"  /></svg>

                        </span>
                    </span>
                </span>
            </div>
        </div>
    </nav>
</template> 