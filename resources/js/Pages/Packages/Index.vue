<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import axios from "axios";
import Loading from "@/Components/Loading.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import InputSearch from "@/Components/InputSearch.vue";
import DropDownHead from "@/Components/DropDownHead.vue";
import Dialog from "@/Components/Dialog.vue";
import { ref } from "vue";
const props = defineProps({
    packages: {
        type: Array,
    },
    filters: {
        type: Array,
    },
});
const isOpen = ref(false);

function openModal() {
    isOpen.value = !isOpen.value;
}
const form = useForm({
    search: props.filters.search,
});
</script>

<template>
    <Head title="Packages" />

    <AuthenticatedLayout>
        <div class="mb-3 flex flex-col gap-3">
            <SectionTitle title="List of Packages" class="" main></SectionTitle>
            <form @submit.prevent="form.get(route('package.index'))">
                <div class="flex justify-between w-full lg:flex-row flex-col">
                    <InputSearch v-model="form.search" />
                    <div class="flex items-center justify-center gap-3">
                        <button
                            type="button"
                            @click="openModal"
                            class="border justify-center hover:bg-blue-50 rounded-md bg-white/20 px-4 py-2 text-sm font-medium text-blue-600  focus:outline-none focus-visible:ring-2 focus-visible:ring-black/75"
                        >
                            Add a package
                        </button>
                        <DropDownHead />
                    </div>
                </div>
            </form>
        </div>
        <Dialog :open="openModal" :isOpen="isOpen"> yooo </Dialog>

        <!-- Loading indicator -->
        <Loading v-if="load" />

        <table>
            <thead>
                <tr>
                    <th class="text-left">Tracking Code</th>
                    <th class="text-left">Store</th>
                    <th class="text-left">Package</th>
                    <th class="text-left">Status</th>
                    <th class="text-left">Client Full Name</th>
                    <th class="text-left">Phone</th>
                    <th class="text-left">Wilaya</th>
                    <th class="text-left">Commune</th>
                    <th class="text-left">Delivery Type</th>
                    <th class="text-left">Status Name</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in packages.data" :key="item.tracking_code">
                    <td>{{ item.tracking_code }}</td>
                    <td>{{ item.store.name }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.status.name }}</td>
                    <td>
                        {{ item.client_first_name }} {{ item.client_last_name }}
                    </td>
                    <td>{{ item.client_phone }}</td>
                    <td>{{ item.commune.wilaya.name }}</td>
                    <td>{{ item.commune.name }}</td>
                    <td>{{ item.delivery_type.name }}</td>
                    <td>{{ item.status.name }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="py-4">
            <Pagination :data="packages" />
        </div>
    </AuthenticatedLayout>
</template>
