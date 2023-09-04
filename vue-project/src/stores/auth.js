import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    apiToken: null,
  }),
  getters: {
    isAuthenticated: (state) => !!state.apiToken,
  },
  actions: {
    setApiToken(token) {
      this.apiToken = token;
    },
    clearApiToken() {
      this.apiToken = null;
    },
  },
});
