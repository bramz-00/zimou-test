<script setup>


const model = defineModel();
const props = defineProps({
  routeName: {
    type: String,
    required: true,
  },
  multiple: Boolean,
  form: Boolean,
  filter: Boolean,

});
</script>

<template>

           
           <div class=" focus:border-red-500 flex  border rounded justify-between focus:ring focus:ring-red-800 border-gray-200 p-0.5">
             <input
               type="search"
               v-model="model"
               class=" focus:border-none  placeholder-slate-400 border-none px-2 w-64  text-sm focus:ring-none focus:ring-white focus:ring-opacity-50"
               placeholder="Search"
             />
             <button 
       
               type="submit"
               color="main_btn"
               small
               class="text-blue-600 px-2 bg-blue-50 transition-all duration-300 hover:text-blue-700 rounded-sm hover:bg-blue-100   "
               >Search</button>
     
           
         </div>
      
</template>
