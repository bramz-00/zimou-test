<template>
    <div v-if="showAlert" class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-md transition-opacity duration-500 ease-in-out" :class="{'opacity-0': !showAlert}">
      {{ message }}
    </div>
  </template>
  
  <script setup>
  import { ref, watch, onMounted } from 'vue';
  
  const props = defineProps({
    message: {
      type: String,
      default: ''
    }
  });
  
  const showAlert = ref(!!props.message);
  
  watch(showAlert, (newVal) => {
    if (newVal) {
      setTimeout(() => {
        showAlert.value = false;
      }, 3000); // Alert will disappear after 3 seconds
    }
  });
  
  onMounted(() => {
    if (props.message) {
      showAlert.value = true;
    }
  });
  </script>
  
  <style scoped>
  .opacity-0 {
    opacity: 0;
  }
  </style>
  