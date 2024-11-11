<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import axios from "axios";
import Loading from "@/Components/Loading.vue";
import SectionTitle from "@/Components/SectionTitle.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import InputSearch from "@/Components/InputSearch.vue";
import DropDownHead from "@/Components/DropDownHead.vue";
import Dialog from "@/Components/Dialog.vue";
import { computed, ref } from "vue";
import SelectButton from "@/Components/SelectButton.vue";
import CreatePackage from "./CreatePackage.vue";
import { mdiMicrosoftExcel } from "@mdi/js";
import Alert from "@/Components/Alert.vue";
const links =  [
    {
        routeName:route('packages.export.csv'),
        label:'Export CSV',
        path:mdiMicrosoftExcel
    },
    {
        routeName:route('packages.export.excel'),
        label:'Export Excel',
        path:mdiMicrosoftExcel
    },

]
const props = defineProps({
    packages: {
        type: Array,
    },
    filters: {
        type: Array,
    },
});

const form = useForm({
    search: props.filters.search,
});
const page = usePage();
const successMessage = computed(() => page.props.flash?.message || '');
</script>

<template>
    <Head title="Packages" />

    <AuthenticatedLayout>
        <div class="mb-3 flex flex-col gap-3">
            <SectionTitle  title="List of Packages" class="" main></SectionTitle>
            <Alert v-if="successMessage" :message="successMessage" />
            <form @submit.prevent="form.get(route('package.index'))">
                {{ $page.props.flash ? $page.props.flash.message:'' }}
                <div class="flex justify-between w-full lg:flex-row flex-col">
                    <InputSearch v-model="form.search" />
                    <div class="flex items-center justify-center gap-3">
                        <CreatePackage />

                        <DropDownHead title="Export as" :links="links"  />
               
                    </div>
                </div>
            </form>
        </div>

        <!-- Loading indicator -->
        <Loading v-if="load" />

        <table>
            <thead>
                <tr>
                    <th class="text-left ">Tracking Code</th>
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
                    <td data-label="Tracking Code" class="  " > {{ item.tracking_code }}</td>
                    <td data-label="Store">{{ item.store.name }}</td>
                    <td data-label="Package">{{ item.name }}</td>
                    <td data-label="Status">{{ item.status.name }}</td>
                    <td data-label="Client Full Name">
                        {{ item.client_first_name }} {{ item.client_last_name }}
                    </td>
                    <td data-label="Phone">{{ item.client_phone }}</td>
                    <td data-label="Wilaya">{{ item.commune.wilaya.name }}</td>
                    <td data-label="Commune">{{ item.commune.name }}</td>
                    <td data-label="Delivery Type">{{ item.delivery_type.name }}</td>
                    <td data-label="Status Name">{{ item.status.name }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination Controls -->
        <div class="py-4">
            <!-- <Pagination :data="packages" /> -->
            <Pagination :pagination="packages.meta" />
        </div>
    </AuthenticatedLayout>
</template>
