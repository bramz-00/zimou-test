<template>
    <Combobox v-model="model" >
        <div class="relative mt-1">
            <div
                class=" w-full flex py-1 cursor-default overflow-hidden rounded bg-white text-left border focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75 focus-visible:ring-offset-2 focus-visible:ring-offset-blue-300 sm:text-sm"
            >
       
                <ComboboxInput
                :placeholder="placeholder"
                    class="w-full border-none  py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
                    :displayValue="(person)=>selectRessource"
                    @change="query = $event.target.value"
                />
                <XMarkIcon v-if="model"  @click="() => {
                    removeSingleSelected();
                }
                    "size="18" w="5" h="5 "
                    class="w-6 cursor-pointer " />
                <ComboboxButton
                class=" inset-y-0 right-0 flex items-center pr-2"
                >

                    <ChevronUpDownIcon
                        class="h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                </ComboboxButton>
            </div>
            <TransitionRoot
                leave="transition ease-in duration-100"
                leaveFrom="opacity-100"
                leaveTo="opacity-0"
                @after-leave="query = ''"
            >
                <ComboboxOptions
                    class="absolute z-40 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base ring-1 ring-black/5 focus:outline-none sm:text-sm"
                >
                    <div
                        v-if="filteredPeople.length === 0 && query !== ''"
                        class="relative cursor-default select-none px-4 py-2 text-gray-700"
                    >
                        Nothing found.
                    </div>

                    <ComboboxOption
                        v-for="person in filteredPeople"
                        as="template"
                        :key="person.id"
                        :value="person.id"
                        v-slot="{ selected, active }"
                    >
                        <li
                            class="relative cursor-default select-none py-2 pl-10 pr-4"
                            :class="{
                                'bg-blue-600 text-white': active,
                                'text-gray-900': !active,
                            }"
                        >
                            <span
                                class="block truncate"
                                :class="{
                                    'font-medium': selected,
                                    'font-normal': !selected,
                                }"
                            >
                                {{ person.name }}
                            </span>
                            <span
                                v-if="selected"
                                class="absolute inset-y-0 left-0 flex items-center pl-3"
                                :class="{
                                    'text-white': active,
                                    'text-blue-600': !active,
                                }"
                            >
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ComboboxOption>
                </ComboboxOptions>
            </TransitionRoot>
        </div>
    </Combobox>
</template>

<script setup>
import { ref, computed } from "vue";
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from "@headlessui/vue";
import { CheckIcon, ChevronUpDownIcon, XMarkIcon } from "@heroicons/vue/20/solid";
import { ClockIcon, MinusIcon } from "@heroicons/vue/24/outline";

const props = defineProps({
    options: Array,
    placeholder:String
});

const model = defineModel();
function getSelectedName(formValue) {
    if (props.options.length > 0) {
            const selectedOption = props.options.find((option) => option?.id == formValue);
            return selectedOption ? selectedOption.name : ''; // Return the 'designation' field
    }

}

var selectRessource = computed(() => getSelectedName(model.value));
let query = ref("");

let filteredPeople = computed(() =>
    query.value === ""
        ?  props.options
        : props.options.filter((person) =>
              person.name
                  .toLowerCase()
                  .replace(/\s+/g, "")
                  .includes(query.value.toLowerCase().replace(/\s+/g, ""))
          )
);
function removeSingleSelected() {
    model.value = null;

}
</script>
