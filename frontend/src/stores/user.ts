import localStorageService from '@/services/local-storage/localStorageService';
import { defineStore } from 'pinia';

export interface UserStorage {
  id: number;
  name: string;
  email: string;
  value: number
}

export const useUserStore = defineStore('user', {
  state: () => ({
    usuario: localStorageService.get<UserStorage>('@user'),
  }),
  getters: {
    obterNomeUsuario: (state) => state.usuario?.name,
    getUserBalance: (state) => state.usuario?.value,
    obterIdUsuario: (state) => state.usuario?.id,
  },
  actions: {
    buscarUsuario(usuario: UserStorage) {
      return new Promise<void>((resolve) => {
        localStorageService.set('@user', usuario);

        this.usuario =
          localStorageService.get<UserStorage>('@user');

        resolve();
      });
    },
    limparUsuario() {
      localStorageService.clear('@user');

      this.usuario = null;
    },
  },
});
