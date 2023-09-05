import { defineStore } from 'pinia';

export const useQuotesStore = defineStore('quotes', {
  state: () => ({
    quotes: null,
  }),
  getters: {
    getStoredQuotes: (state) => state.quotes,
  },
  actions: {
    setQuotes(payload) {
      this.quotes = payload;
    },
    clearQuotes() {
      this.quotes = null;
    },
  },
});