<template>
    <!-- Static sidebar for desktop -->
    <aside
        class="fixed top-16 left-0 z-40 w-56 h-screen transition-transform -translate-x-full md:translate-x-0"
        aria-label="Sidebar"
    >
        <div class="h-full px-3 py-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                <ChartPieIcon  class="size-6 " />
                    Dashboard
                </NavLink>

                <NavLink
                    :href="route('package.index')"
                    :active="route().current('package.index')"
                >
                <CubeIcon     class="size-6 " />
                    Packages
                </NavLink>
            </ul>
        </div>
    </aside>
</template>

<script setup>
import {  ChartPieIcon, CubeIcon } from "@heroicons/vue/24/outline";
import NavLink from "./NavLink.vue";

const appName = import.meta.env.VITE_APP_NAME || "Mon starter";
</script>

<style lang="scss" scoped></style>
