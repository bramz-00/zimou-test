<template>
  
    <TransitionRoot appear :show="isOpen" as="template">
      <Dialog as="div" class="relative z-40">
        <TransitionChild
          as="template"
          enter="duration-300 ease-out"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="duration-200 ease-in"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div class="fixed inset-0 bg-black/5" />
        </TransitionChild>
        <div class="fixed inset-0 overflow-y-auto">
          <div
          class="flex min-h-full items-center justify-center p-4 text-center"
          >
          <TransitionChild
          as="template"
          enter="duration-300 ease-out"
              enter-from="opacity-0 scale-95"
              enter-to="opacity-100 scale-100"
              leave="duration-200 ease-in"
              leave-from="opacity-100 scale-100"
              leave-to="opacity-0 scale-95"
            >
            <DialogPanel
            
            class="w-[65%]  transform  rounded bg-white p-6 text-left align-middle  transition-all"
            >
            <XMarkIcon class="absolute w-8 right-2 top-2 cursor-pointer" @click="open"/>
            <DialogTitle
              as="h3"
              class="text-lg font-bold leading-6 mb-2 "
            >
              {{ title }}
            </DialogTitle>
            <hr>
                <div class="mt-2">
                <slot/>
                </div>
  
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
  } from '@headlessui/vue'
import { XMarkIcon } from '@heroicons/vue/20/solid';
  
const props = defineProps({
    isOpen:Boolean,
    open:Function,
    w:String,
    title:String

})
  </script>
  