<template>
   
   <div class="flex gap-3 justify-between items-center">
    <span class="text-sm">{{ text }}</span>
      <Switch
        v-model="model"
        :class="model!=true ? 'bg-gray-200' : 'bg-blue-700'"
        class="relative flex py-1 px-4 shrink-0 cursor-pointer rounded border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
      >
        <span
          aria-hidden="true"
          :class="model ? 'translate-x-3' : '-translate-x-3'"
          class="pointer-events-none inline-block h-3 w-3 transform rounded-sm bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
        />
      </Switch>
   </div>
 
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { Switch } from '@headlessui/vue'
  const props = defineProps({
    text:String
  })
  const model = defineModel()
  </script>
  