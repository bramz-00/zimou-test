<script setup>
const props = defineProps({
    disabled:Boolean,
    id:Number,
    name:String,
    type:String,
    placeholder:String,
    required:Boolean,

})
const model = defineModel()

</script>


<template>
            <div class="relative mt-1">

            <div                 class=" w-full flex py-1 cursor-default overflow-hidden rounded bg-white text-left border focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-blue-300 sm:text-sm"
            >

                <textarea
                v-if="type == 'textarea'"
                :disabled="disabled"
                  :id="id"
                  v-model="model"
                  class=" w-full border-none  py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
                  :name="name"
                  :placeholder="placeholder"
                  :required="required"
                />
                <input
                  v-else
                  :id="id"
                  ref="inputEl"
                  :disabled="disabled"
                  v-model="model"
                  :name="name"
                  :inputmode="inputmode"
                  :autocomplete="autocomplete"
                  :required="required"
                  :placeholder="placeholder"
                  :type="type"
                  class=" w-full border-none  py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
                  >
            </div>
</div>



</template>