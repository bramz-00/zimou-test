<script setup>
import Dialog from "@/Components/Dialog.vue";
import FormControl from "@/Components/FormControl.vue";
import FormField from "@/Components/FormField.vue";
import SelectButton from "@/Components/SelectButton.vue";
import SwitchButton from "@/Components/SwitchButton.vue";
import { fetchRef } from "@/Stores/fetchRef";
import { useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
 import { vMaska } from "maska/vue"
const isOpen = ref(false);


const package_status = ref([]);
const stores = ref([]);
const delivery_types = ref([]);
const communes = ref([]);

const store = fetchRef();

async function fetchPackageStatus() {
    let statusData = await store.fetchPackageStatus(
        route("package.status.fetch")
    );
    package_status.value = statusData;
}
async function fetchCommunes() {
    let communesData = await store.fetchCommunes(route("commune.fetch"));
    communes.value = communesData;
}
async function fetchStores() {
    let storesData = await store.fetchStores(route("store.fetch"));
    stores.value = storesData;
}
async function fetchDeliveryType() {
    let delivery_typesData = await store.fetchDeliveryType(
        route("delivery-type.fetch")
    );
    delivery_types.value = delivery_typesData;
}

onMounted(async () => {
    await fetchCommunes();
    await fetchDeliveryType();
    await fetchStores();
    await fetchPackageStatus();
});

const form = useForm({
    commune_id: "",
    store_id: "",
    delivery_type_id: "",
    client_phone2: "",
    name: "",
    address: '',
    client_phone: "",
    client_first_name: "",
    client_last_name: "",


    partner_delivery_price: "",
    partner_cod_price: "",
    weight: "",
    total_price: "",
    price_to_pay: "",
    packaging_price: "",
    partner_return: "",
    return_price:'',
    price: "",
    delivery_price: "",
    commission: "",
    cod_to_pay: "",
    extra_weight_price: "",

    status_id: "",
    can_be_opened: false,
    free_delivery: false,


    tracking_code: "",
});
async function submit(){
    form.post(route('package.store'))
   if(form.errors==null){
    await openModal()
   }

}
function openModal() {
    isOpen.value = !isOpen.value;
    form.reset()
}

</script>
<template>
    <div>
        <button
        type="button"
        @click="openModal"
        class="border justify-center hover:bg-blue-50 rounded-md bg-white/20 px-4 py-2 text-sm font-medium text-blue-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-black/75"
        >
        Add a package
    </button>
    <Dialog
    :open="openModal"
    title="Add a package"
    :isOpen="isOpen"
    w="w-full"
    >
    <form action=""     @submit.prevent="submit()"
    >
        <div class="grid grid-cols-2 gap-3">
                   <FormField required  :label="'Store'"  :class="{ 'text-red-400': form.errors.store_id }" class="md:grid-cols-1">
                        <SelectButton v-model="form.store_id" :options="stores" placeholder='Select a store'/>
                        <div class="text-red-400 text-sm" v-if="form.errors.store_id" >
                            {{ form.errors.store_id }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Tracking code'"   :class="{ 'text-red-400': form.errors.tracking_code }"
                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.tracking_code"   type="text"  :placeholder="'Enter tracking code'"
                            :error="form.errors.tracking_code" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.tracking_code" >
                            {{ form.errors.tracking_code }}
                        </div>
                        
                    </FormField>

                    <FormField   :label="'Name'"   :class="{ 'text-red-400': form.errors.name }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.name"   type="text"  :placeholder="'Enter a name'" :error="form.errors.name" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.name" >
                            {{ form.errors.name }}
                        </div>
                    </FormField>
                    <FormField  required   :label="'Commune'" :class="{ 'text-red-400': form.errors.commune_id }"  class="md:grid-cols-1"  >
                        <SelectButton    v-model="form.commune_id" :options="communes"      placeholder='Select a commune'/>
                        <div class="text-red-400 text-sm"     v-if="form.errors.commune_id">
                            {{ form.errors.commune_id }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Client firstname'"   :class="{ 'text-red-400': form.errors.client_first_name }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.client_first_name"   type="text"  :placeholder="'Enter a client firstname'" :error="form.errors.client_first_name" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.client_first_name" >
                            {{ form.errors.client_first_name }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Client lastname'"   :class="{ 'text-red-400': form.errors.client_last_name }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.client_last_name"   type="text"  :placeholder="'Enter a client lastname'" :error="form.errors.client_last_name" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.client_last_name" >
                            {{ form.errors.client_last_name }}
                        </div>
                    </FormField>
                    <FormField required   :label="'Client Phone'"   :class="{ 'text-red-400': form.errors.client_phone }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.client_phone"   type="text"  :placeholder="'Enter a client phone'" :error="form.errors.client_phone" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.client_phone" >
                            {{ form.errors.client_phone }}
                        </div>
                    </FormField>

                    <FormField required  :label="'Client Phone 2'"   :class="{ 'text-red-400': form.errors.client_phone2 }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.client_phone2"   type="text"  :placeholder="'Enter a client phone 2'" :error="form.errors.client_phone2" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.client_phone2" >
                            {{ form.errors.client_phone2 }}
                        </div>
                    </FormField>
                  

                   

                   
                    <FormField required :label="'Status'" :class="{ 'text-red-400': form.errors.status_id }" class="md:grid-cols-1" >
                        <SelectButton v-model="form.status_id" :options="package_status" placeholder='Select a package status'/>
                        <div class="text-red-400 text-sm" v-if="form.errors.status_id">
                            {{ form.errors.status_id }}
                        </div>
                    </FormField>
                    <FormField required :label="'Delivery type'" :class="{'text-red-400': form.errors.delivery_type_id,}" class="md:grid-cols-1">
                        <SelectButton  v-model="form.delivery_type_id"   :options="delivery_types" placeholder='Select a delivery type'/>
                        <div class="text-red-400 text-sm" v-if="form.errors.commune_id"  >
                            {{ form.errors.delivery_type_id }}
                        </div>
                    </FormField>

                    <FormField required  :label="'Commission'"   :class="{ 'text-red-400': form.errors.commission }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.commission"   type="number"  :placeholder="'Enter a commission'" :error="form.errors.commission" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.commission" >
                            {{ form.errors.commission }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Code to pay'"   :class="{ 'text-red-400': form.errors.cod_to_pay }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.cod_to_pay"   type="number"  :placeholder="'Enter a code to pay'" :error="form.errors.cod_to_pay" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.cod_to_pay" >
                            {{ form.errors.cod_to_pay }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Delivery price'"   :class="{ 'text-red-400': form.errors.delivery_price }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.delivery_price"   type="number"  :placeholder="'Enter a delivery price'" :error="form.errors.delivery_price" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.delivery_price" >
                            {{ form.errors.delivery_price }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Partner delivery price'"   :class="{ 'text-red-400': form.errors.partner_delivery_price }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.partner_delivery_price"   type="number"  :placeholder="'Enter a delivery price'" :error="form.errors.partner_delivery_price" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.partner_delivery_price" >
                            {{ form.errors.partner_delivery_price }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Partner code price'"   :class="{ 'text-red-400': form.errors.partner_cod_price }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.partner_cod_price"   type="number"  :placeholder="'Enter a partner code price'" :error="form.errors.partner_cod_price" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.partner_cod_price" >
                            {{ form.errors.partner_cod_price }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Packaging price'"   :class="{ 'text-red-400': form.errors.packaging_price }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.packaging_price"   type="number"  :placeholder="'Enter a packaging price'" :error="form.errors.packaging_price" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.packaging_price" >
                            {{ form.errors.packaging_price }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Partner return'"   :class="{ 'text-red-400': form.errors.partner_return }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.partner_return"   type="number"  :placeholder="'Enter a partner return'" :error="form.errors.partner_return" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.partner_return" >
                            {{ form.errors.partner_return }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Return price'"   :class="{ 'text-red-400': form.errors.return_price }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.return_price"   type="number"  :placeholder="'Enter a return price'" :error="form.errors.return_price" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.return_price" >
                            {{ form.errors.return_price }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Price'"   :class="{ 'text-red-400': form.errors.price }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.price"   type="number"  :placeholder="'Enter a price'" :error="form.errors.price" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.price" >
                            {{ form.errors.price }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Price to pay'"   :class="{ 'text-red-400': form.errors.price_to_pay }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.price_to_pay"   type="number"  :placeholder="'Enter a price to pay'" :error="form.errors.price_to_pay" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.price_to_pay" >
                            {{ form.errors.price_to_pay }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Total price'"   :class="{ 'text-red-400': form.errors.total_price }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.total_price"   type="number"  :placeholder="'Enter a total price'" :error="form.errors.total_price" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.total_price" >
                            {{ form.errors.total_price }}
                        </div>
                    </FormField>
                    <FormField required  :label="'Extra weight price'"   :class="{ 'text-red-400': form.errors.extra_weight_price }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.extra_weight_price"   type="number"  :placeholder="'Enter a extra weight price'" :error="form.errors.extra_weight_price" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.extra_weight_price" >
                            {{ form.errors.extra_weight_price }}
                        </div>
                    </FormField>
                   <FormField required  :label="'Weight'"   :class="{ 'text-red-400': form.errors.weight }"                        class="md:grid-cols-1"  >
                        <FormControl  v-model="form.weight"   type="number"  :placeholder="'Enter a weight'" :error="form.errors.weight" >
                        </FormControl>
                        <div  class="text-red-400 text-sm" v-if="form.errors.weight" >
                            {{ form.errors.weight }}
                        </div>
                    </FormField>



                    
                    
                    
                    <SwitchButton v-model="form.can_be_opened" text="Can be opened ?"/>
                    <SwitchButton v-model="form.free_delivery" text="Free Delivery ?"/>

                </div>
                <FormField required    :label="'Address'"     :class="{ 'text-red-400': form.errors.commune_id }"  class="md:grid-cols-1" >
                        <FormControl v-model="form.address"  type="textarea"  :placeholder="'Enter an address'" :error="form.errors.address">
                        </FormControl>
                        <div class="text-red-400 text-sm"   v-if="form.errors.address"       >
                            {{ form.errors.address }}
                        </div>
                    </FormField>
              <div class="flex items-center justify-end p-2 mt-2">
                <button
                    type="submit"
                    class="inline-flex hover:bg-blue-50 hover:text-blue-700 border justify-center rounded-md bg-white/20 px-4 py-2 text-sm font-medium text-blue-600  focus:outline-none focus-visible:ring-2 focus-visible:ring-black/75"
                   
                  >
                 Save
                  </button>
                 
              </div>
            </form>
        </Dialog>
    </div>
</template>
