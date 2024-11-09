<script setup>
import { useSlots, computed } from 'vue'


defineProps({
  icon: {
    type: String,
    default: null
  },
  title: {
    type: String,
    required: true
  },
  main: Boolean
})

const hasSlot = computed(() => useSlots().default)
</script>

<template>
  <section 
  
    class="p-2 rounded bg-white flex items-center justify-between "
  >
    <div class="flex items-center justify-start">

      <h1
        :class="main ? 'text-3xl' : 'text-2xl'"
        class="text-black"
      >
        {{ title }}
      </h1>
    </div>
    <slot v-if="hasSlot" />
 
  </section>
</template>
