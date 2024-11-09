<script setup>


import NavBar from '@/Components/NavBar.vue';
import SideBar from '@/Components/SideBar.vue';


</script>

<template>
    <div>
        
        <SideBar />
        <NavBar class="  border" />
        <div class="min-h-screen lg:pl-56 bg-gray-50">

            <!-- Page Heading -->
         

            <!-- Page Content -->
            <main class="pt-20 p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
