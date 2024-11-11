<script setup>
import { computed, useSlots } from 'vue'

defineProps({
  label: {
    type: String,
    default: null
  },
  labelFor: {
    type: String,
    default: null
  },
  help: {
    type: String,
    default: null
  },
  light:Boolean,
  required:Boolean
})

const slots = useSlots()

const wrapperClass = computed(() => {
  const base = []
  const slotsLength = slots.default().length

  if (slotsLength > 1) {
    base.push('grid grid-cols-1 gap-3 ')
  }

  if (slotsLength == 2) {
    base.push('md:grid-cols-1')
  }

  return base
})
</script>

<template>
  <div class="  ">
    <label
      v-if="label"
      :for="labelFor"
      class="block font-semibold text-md   "
    >
   
    {{ label }}  <span v-if="required" class="text-red-500 ">
      *
    </span> </label>
    <div :class="wrapperClass">
      <slot />
    </div>
   
  </div>
</template>
