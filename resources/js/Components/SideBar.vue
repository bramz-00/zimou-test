<template>
    <!-- Static sidebar for desktop -->
    <aside
        id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-72 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar"
    >
        <div class="h-full px-3 py-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                >
                    Dashboard
                </NavLink>

                <NavLink
                    :href="route('prof')"
                    :active="route().current('prof')"
                >
                    Users
                </NavLink>
            </ul>
        </div>
    </aside>
</template>

<script setup>
import NavLink from "./NavLink.vue";

const appName = import.meta.env.VITE_APP_NAME || "Mon starter";
</script>

<style lang="scss" scoped></style>
