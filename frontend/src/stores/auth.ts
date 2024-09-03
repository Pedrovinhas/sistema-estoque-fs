import localStorageService from '@/services/local-storage/localStorageService';
import { defineStore } from 'pinia';

interface AuthStorage {
  access_token: string;
  expires: string;
}

export const useAuthStore = defineStore('auth', {
  state: () => ({
    authStorage: localStorageService.get<AuthStorage>('@auth'),
  }),
  getters: {
    getToken: (state) => state.authStorage?.access_token,
    isAuthenticated(): boolean {
      return Boolean(this.authStorage?.access_token);
    },
  },
  actions: {
    async login(data: AuthStorage) {
      return new Promise<void>((resolve) => {
        localStorageService.set('@auth', data);

        this.authStorage = localStorageService.get<AuthStorage>('@auth');

        resolve();
      });
    },
    logout() {
      localStorageService.clear('@auth');

      this.authStorage = null;
    },
  },
});
