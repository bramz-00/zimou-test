<script setup>


import NavBar from '@/Components/NavBar.vue';
import SideBar from '@/Components/SideBar.vue';


</script>

<template>
    <div>
        <SideBar />
        
        <NavBar class=" lg:pl-72 border" />
        <div class="min-h-screen lg:pl-72 bg-gray-100">

            <!-- Page Heading -->
         

            <!-- Page Content -->
            <main class="pt-10 ">
                <slot />
            </main>
        </div>
    </div>
</template>
