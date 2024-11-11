import { defineStore } from 'pinia';

export const fetchRef = defineStore('fetchRef', {
  state: () => ({

  }),
  actions: {
   
      async fetchCommunes(route) {
        const response = await fetch(route);
        const data = await response.json();
        return data.communes
      },
      async fetchStores(route) {
        const response = await fetch(route);
        const data = await response.json();
        return data.stores
      },

      async fetchDeliveryType(route) {
        const response = await fetch(route);
        const data = await response.json();
        return data.delivery_types
      },
      async fetchPackageStatus(route) {
        const response = await fetch(route);
        const data = await response.json();
        return data.package_status
      },
  },
  getters: {
    // Get the marques data from the state of the Pinia stor
  },
});

// Set the marques data in the initial data
